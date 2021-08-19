
@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('bredibanner::controle.banner.index') }}">Banners</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        Banners
        {{-- <small>header small text goes here...</small> --}}
    </h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-lg-6">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Banners</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(isset($banner) ? $banner : null,['route' => (isset($banner->id) ? ['bredibanner::controle.banner.update', $banner->id] : 'bredibanner::controle.banner.store'), 'files' => true]) !!}
                        <fieldset>
                            <legend class="m-b-15">Banner</legend>
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                {!! Form::text('titulo', null, ['class' => 'form-control', checkRequired('bredibanner.request_valitation.titulo')]) !!}
                            </div>
                            <div class="form-group">
                                <label for="subtitulo">Subtitulo</label>
                                {!! Form::text('subtitulo', null, ['class' => 'form-control', checkRequired('bredibanner.request_valitation.subtitulo')]) !!}
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                {!! Form::text('link', null, ['class' => 'form-control', checkRequired('bredibanner.request_valitation.link')]) !!}
                            </div>
                            <div class="form-group">
                                <label for="link_name">Texto do Link</label>
                                {!! Form::text('link_name', null, ['class' => 'form-control', checkRequired('bredibanner.request_valitation.link_name')]) !!}
                            </div>
                            <div class="form-group">
                                <label for="imagem">Banner/Background</label>
                                @if(!empty($banner->imagem))
                                    <div>
                                        <img src="{{ route('imagem.render', 'banner/g/' . $banner->imagem) }}" class="img-fluid">
                                    </div>
                                @endif
                                {!! Form::file('imagem', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="imagem_2">Imagem 2</label>
                                @if(!empty($banner->imagem_2))
                                    <div>
                                        <img src="{{ route('imagem.render', 'banner/g/' . $banner->imagem_2) }}" class="img-fluid">
                                    </div>
                                @endif
                                {!! Form::file('imagem_2', ['class' => 'form-control']) !!}
                            </div>
                            <div class="checkbox checkbox-css m-b-20">
                                <div class="form-check m-r-10">
                                    {!! Form::checkbox('ativo', 1, null, ['class' => 'form-check-input', 'id' => 'ativo']) !!}
                                    <label class="form-check-label" for="ativo">Publicar</label>
                                </div>
                            </div>
                            @can((isset($banner->id)) ? 'controle.banner.update' : 'controle.banner.store')
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>
                            @endcan
                            <a href="{{ route('bredibanner::controle.banner.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                        </fieldset>
                    {!! Form::close() !!}

                </div> <!-- panel-body -->
            </div>
            <!-- end panel -->

        </div>
    </div>

@stop
