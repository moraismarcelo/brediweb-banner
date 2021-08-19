<?php

namespace Bredi\BrediBanner\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'titulo', 'subtitulo', 'link', 'imagem', 'imagem_2', 'tipo', 'ativo', 'dias_semana', 'hora_inicio', 'hora_termino', 'data_inicio', 'data_termino', 'link_name', 'order'
    ];

    protected $appends = ['image_banner', 'image_secondary'];

    protected $hidden = ['deleted_at'];

    public function getImageBannerAttribute()
    {
        $tamanhos  = array_keys(config('bredibanner.config.imagem.resolucao'));
        $sizeImage = [];

        if (!empty($this->imagem)) {
            if(count($tamanhos) > 0) {
                foreach($tamanhos as $tamanho) {
                    $sizeImage[$tamanho] = route('imagem.render', config('bredibanner.config.imagem.destino') . $tamanho . '/' . $this->imagem);
                }
            }
        }

        return $sizeImage;
    }

    public function getImageSecondaryAttribute()
    {
        $tamanhos  = array_keys(config('bredibanner.config.imagem_2.resolucao'));
        $sizeImage = [];

        if (!empty($this->imagem_2)) {
            if(count($tamanhos) > 0) {
                foreach($tamanhos as $tamanho) {
                    $sizeImage[$tamanho] = route('imagem.render', config('bredibanner.config.imagem_2.destino') . $tamanho . '/' . $this->imagem_2);
                }
            }
        }

        return $sizeImage;
    }

    public static function scopeFilter($query, $input)
    {
        $exclude = ['limit', 'order_by', 'order', 'hash', 'id'];

        if (count($input) > 0) {
            foreach($input as $d => $in) {
                if (!in_array($d, $exclude)) {
                    $query->where($d, $in);
                }
            }
        }

        if (!isset($input['limit'])) {
            $input['limit'] = 10;
        }
        if (!isset($input['order_by'])) {
            $input['order_by'] = 'id';
        }

        // if (isset($input['hash'])) {
        //     $query->where('hash', $input['hash']);
        // }

        $tiposOrder = ['asc', 'desc', 'random'];

        if (!isset($input['order'])) {
            $input['order'] = 'asc';
        } else {
            if (in_array($input['order'], $tiposOrder)) {
                if ($input['order'] == 'random') {
                    $query->inRandomOrder();
                } else {
                    $query->orderBy($input['order_by'], $input['order']);
                }
            } else {
                $input['order'] = 'asc';
                $query->orderBy($input['order_by'], $input['order']);
            }
        }

        if (isset($input['hash']) || isset($input['id'])) {
            $query = $query->first();
        } else {
            $query = $query->paginate($input['limit']);
        }
        // $query->orderBy($input['order_by'], $input['order']);

        return $query;
    }
}
