<?php

namespace Brediweb\BrediBanner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\BrediBanner\Models\Banner;
use Brediweb\ImagemUpload\ImagemUpload;

class BrediBannerController extends Controller
{
    public function __construct()
    {
        $this->config = config('bredibanner.config');

    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $banners = Banner::orderBy('order')->get();

        return view('bredibanner::controle.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bredibanner::controle.banner.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(config('bredibanner.request_valitation'));

        try {

            $input = $request->all();

            $imagens = ImagemUpload::salva($this->config['imagem']);
            $imagem2 = ImagemUpload::salva($this->config['imagem_2']);

            if ($imagens) {
                $input['imagem'] = $imagens;
            }
            if ($imagem2) {
                $input['imagem_2'] = $imagem2;
            }

            $banner = Banner::create($input);

            return redirect()->route('bredibanner::controle.banner.index')->with('msg', 'Banner cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível salvar os dados')->with('error', true)->with('exception', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('bredibanner::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('bredibanner::controle.banner.form', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(config('bredibanner.request_valitation'));

        $input = $request->except('_token');
        $input['ativo'] = (isset($input['ativo'])) ? 1 : 0;

        $imagens = ImagemUpload::salva($this->config['imagem']);
        $imagem2 = ImagemUpload::salva($this->config['imagem_2']);

        if ($imagens) {
            $input['imagem'] = $imagens;
        }
        if ($imagem2) {
            $input['imagem_2'] = $imagem2;
        }

        try {

            $banner = Banner::find($id)->update($input);

            return redirect()->route('bredibanner::controle.banner.index')->with('msg', 'Registro atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível alterar o registro')->with('error', true)->with('exception', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::find($id);

            $imagem = $banner->imagem;
            $imagem2 = $banner->imagem_2;

            $this->config['imagem']['imagem'] = $imagem;
            $this->config['imagem_2']['imagem'] = $imagem2;

            $banner->delete();

            if (!empty($imagem)) {
                ImagemUpload::deleta($this->config['imagem']);
            }
            if (!empty($imagem2)) {
                ImagemUpload::deleta($this->config['imagem_2']);
            }

            return redirect()->route('bredibanner::controle.banner.index')->with('msg', 'registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('bredibanner::controle.banner.index')->with('msg', 'não foi possível excluir o registro!')->with('exception', $e->getMessage());
        }
    }

    public function listarBanner()
    {
        try {
            $banners = (new \Brediweb\BrediBanner\Repository\BannerRepository)->getBannersAtivos();

            return $banners;

        } catch (\Exception $e) {

            return sendError($e, 500);
        }

    }
}
