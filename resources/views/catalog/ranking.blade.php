@extends('layouts.master')

@section('content')

    <div class="row">

        @foreach($Favourites as $fav)

        <div class="col-xs-6 col-sm-4 col-md-3 text-center">
    
            <a href="{{ url('/catalog/show/' . $fav->id ) }}">
    
                <img src="{{$fav->poster}}" style="height:200px"/>
    
                <h4 style="min-height:45px;margin:5px 0 10px 0">
    
                    {{$fav->title}} <span class="glyphicon glyphicon-heart"></span> {{$fav->count}}
    
                </h4>
    
            </a>
    
        </div>

        @endforeach

    </div>

@stop