@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-3"> 

            <img src="{{$Pelicula->poster}}"/>

    </div>

    <div class="col-md-8">

        <h1>{{$Pelicula->title}}</h1>

        <h3>Año: {{$Pelicula->year}}</h3>

        <h3>Director: {{$Pelicula->director}}</h3>

        <br>

        <p><b>Resumen: </b>{{$Pelicula->synopsis}}</p>

        @if ($Pelicula->rented == 1)

        <p><b>Estado: </b>Película actualmente alquilada</p>

        @else

        <p><b>Estado: </b>Disponible</p>

        @endif

        <br>

        <div>

            
            @if ($Pelicula->rented == 1)

            <form action="{{action('CatalogController@putReturn', $Pelicula->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="display:inline">
                    Devolver película
                </button>
            </form>

            @else

            <form action="{{action('CatalogController@putRent', $Pelicula->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success" style="display:inline">
                    Alquilar película
                </button>
            </form>

            @endif

            <a href="{{ url('/catalog/edit/' . $Pelicula->id ) }}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar Película</button></a>

            <form action="{{action('CatalogController@deleteMovie', $Pelicula->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-info" style="display:inline">
                    Borrar película
                </button>
            </form>
            
            <form action="{{action('CatalogController@getIndex')}}" 
                method="POST" style="display:inline">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default" style="display:inline">
                <span class="glyphicon glyphicon-chevron-left">
                </span> 
                Volver al listado
            </button>
            </form>
            

        </div>

    </div>
    
</div>
@stop