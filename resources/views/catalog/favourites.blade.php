@extends('layouts.master')

@section('content')

    <div class="row">
@if (!empty($arrayPeliculas))
        @foreach( $arrayPeliculas as $pelicula )

        <div class="col-xs-6 col-sm-4 col-md-3 text-center">
    
            <a href="{{ url('/catalog/show/' . $pelicula[0]->id ) }}">
    
                <img src="{{$pelicula[0]['poster']}}" style="height:200px"/>
    
                <h4 style="min-height:45px;margin:5px 0 10px 0">
    
                    {{$pelicula[0]->title}}
    
                </h4>
    
            </a>
    
        </div>
        
        @endforeach
    @else
        <h1>De momento no has registrado ninguna película favorita</h1>
        <h2>Siéntate y relájate <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></h2>
    @endif
    </div>

@stop