@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-3"> 

            <img src="{{$Pelicula->poster}}" style="width: 100%; margin-bottom: 10%"/>

            <iframe width="100%" src="https://www.youtube.com/embed/  {{$Pelicula->trailer}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    </div>

    <div class="col-md-8">

        <h1>{{$Pelicula->title}}</h1>

        <h3>Año: {{$Pelicula->year}}</h3>

        <h3>Director: {{$Pelicula->director}}</h3>

        <h3>Categoría: {{$Pelicula->category->title}}</h3>

        <br>

        <p><b>Resumen: </b>{{$Pelicula->synopsis}}</p>

        @if ($Pelicula->rented == 1)

        <p><b>Estado: </b>Película actualmente alquilada</p>

        @else

        <p><b>Estado: </b>Disponible</p>

        @endif

        <br>

        <div>

            

            @if($Fav == false)

            <form action="{{action('FavouriteController@getFavourite', $Pelicula->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-heart"></span> Favoritos</button>
            </form>

            @else
            <form action="{{action('FavouriteController@deleteFavourite', $Pelicula->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-heart"></span> Favoritos</button>
            </form>

            @endif

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

        <div style="margin-top:25px;">
        <h3>Comentarios</h3>
        @foreach( $Reviews ?? '' as $Review )
        <div class="card border-light">
            <div class="card-body" style="border-left: 5px solid lightgrey; padding-left: 1%">
            <h5 class="card-title">{{$Review->title}}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{$Review->stars}} Estrellas</h6>
              <p class="card-text">{{$Review->review}}</p>
              <footer class="blockquote-footer"> {{date('d/m/Y', strtotime($Review->created_at))}} - <cite title="Source Title">{{$Review->user->name}}</cite></footer>
            </div>
          </div>
          @endforeach
            <form method="POST" action="{{action('CatalogController@postReview', $Pelicula->id)}}"  style="margin-top:25px;line-height: 5%">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <div class="form-group mb-3 mt-3">
                    <label for="title">Enviar comentario</label>
                    <input type="text" name="title" id="title" class="form-control mt-3 @error('title') is-invalid @enderror"  placeholder="Resumen del comentario" required>
                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                 </div>
                 <h5>Valoración</h5>
                 <div class="input-group mb-3 mt-3">
                    <select class="custom-select" id="stars" name="stars" style="width: 100%; height: 5%" required>
                      <option selected value="1">1 Estrella</option>
                      <option value="2">2 Estrellas</option>
                      <option value="3">3 Estrellas</option>
                      <option value="4">4 Estrellas</option>
                      <option value="5">5 Estrellas</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <textarea name="review" id="review" class="form-control" rows="3" placeholder="Da tu opinión" required></textarea>
                 </div>
                 <div class="form-group text-center" style="display:inline">
                    <input type="submit" class="btn btn-success" style="margin-bottom:25px;" value="Valorar"/>
                    
                 </div>
                 <div class="form-group text-center" style="display:inline">
                    <button class="btn btn-dark btn-close" style="margin-bottom:25px;">
                    Cancelar
                    </button>
                 </div>
            </form>
        </div>

    </div>
    
</div>
@stop