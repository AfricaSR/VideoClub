@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12">

        <h1 style="display: inline" class="mr-3 mb-5">{{$Category->title}}</h1>

        @if ($Category->adult == 1)

        <span class="badge badge-pill badge-warning mb-5" style="display: inline">Para Adultos</span>

        @else

        <span class="badge badge-pill badge-primary mb-5" style="display: inline">Público variado</span>

        @endif

        <p class="mt-5 mb-5"><b>Descripción: </b>{{$Category->description}}</p>

        <div class="row">

            @foreach( $Peliculas as $pelicula )
        
            <div class="col-xs-6 col-sm-4 col-md-3 text-center">
        
                <a href="{{ url('/catalog/show/' . $pelicula->id ) }}">
        
                    <img src="{{$pelicula['poster']}}" style="height:200px"/>
        
                    <h4 style="min-height:45px;margin:5px 0 10px 0">
        
                        {{$pelicula->title}}
        
                    </h4>
        
                </a>
        
            </div>
            
            @endforeach
        
            </div>

            
            <form action="{{action('CategoryController@index')}}" 
                method="POST" style="display:inline">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default mt-3" style="display:block">
                <span class="glyphicon glyphicon-chevron-left">
                </span> 
                Volver al listado
            </button>
            </form>
            

        </div>

        
    
</div>
@stop