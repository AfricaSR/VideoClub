@extends('layouts.master')

@section('content')
<p style="font-size: 30px;">Lista de Categorías<p>
    <a href="{{ url('/category/create') }}"><button type="button" class="btn btn-success">Nueva Categoría</button></a>
  <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titol</th>
                <th scope="col">Descripció</th>
                <th scope="col">Nomes per adults</th>
                <th scope="col">Accions</th>
            </tr>
        </thead>
        <tbody>

    @foreach( $Categories as $Category )

    <tr>
    <th scope="row">{{$Category->id}}</th>
        <td>{{$Category->title}}</td>
        <td style="width: 33%; text-align: justify">{{$Category->description}}</td>
        <td style="text-align: center">

            @if ($Category->adult == 1)

            Si

            @else

            No

            @endif

        </td>
        <td>
            <a href="{{ url('/category/' . $Category->id ) }}"><button type="button" class="btn btn-success" style="width: 30%">Mostrar</button></a>
            <form action="{{action('CategoryController@edit', $Category->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary" style="width: 30%">
                    Editar
                </button>
            </form>
            
            <form action="{{action('CategoryController@destroy', $Category->id)}}" 
                method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="width: 30%">
                    Borrar
                </button>
            </form>
            
        </td>
      </tr>
    
    @endforeach

</tbody>
</table>

@stop