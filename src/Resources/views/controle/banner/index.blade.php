
@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('bredibanner::controle.banner.index') }}">Banners</a></li>
    @endcomponent
 
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        Banners {{--<small>header small text goes here...</small> --}}
    </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                    @can('controle.banner.create')
                    <a href="{{ route('bredibanner::controle.banner.create') }}" class="btn btn-xs btn-circle2 btn-success"><i class="fa fa-plus"></i> Novo Registro</a>
                    @endcan
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Banners</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>Ordem</th>
                            <th>Imagem</th>
                            <th>Titulo</th>
                            <th>Link</th>
                            <th>Publicado</th>
                            <th width="1%">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @forelse($banners as $banner)
                        <tr id="{{ $banner->id }}">
                            <td>{{ $banner->order }}</td>
                            <td class="with-img">
                                @if(!empty($banner->imagem))
                                <img src="{{ route('imagem.render', 'banner/p/' . $banner->imagem) }}" class="img-rounded height-30">
                                @endif
                            </td>
                            <td>{{ (isset($banner->titulo) and !empty($banner->titulo)) ? $banner->titulo : '-' }}</td>
                            <td>{{ (isset($banner->link) and !empty($banner->link)) ? $banner->link : '-' }}</td>
                            <td>
                                <span class="fa fa-{{ ($banner->ativo == 1) ? 'check-' : '' }}circle"></span>
                            </td>
                            <td class="with-btn" nowrap="">
                                @can('controle.banner.edit')
                                    <a href="{{ route('bredibanner::controle.banner.edit', $banner->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">Editar</a>
                                @endcan
                                @can('controle.banner.destroy')
                                <a href="javascript:void(0)" data-url="{{ route('bredibanner::controle.banner.destroy', $banner->id) }}" class="btn btn-sm btn-white width-60 atencao">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                Nenhum registro foi encontrado.
                            </td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end panel -->
@stop

@section('scripts')
<script>
    sortable('banners')
</script>
@endsection