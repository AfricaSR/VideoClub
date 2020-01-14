@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
         Modificar película
         </div>
         <div class="card-body" style="padding:30px">

            <form method="POST">
            
            {{ csrf_field() }}
            {{method_field('PUT')}}

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control" value="{{$Pelicula->title}}">
            </div>

            <div class="form-group">
                <label for="title">Año</label>
                <input type="number" name="anio" id="anio" min="1900" max="2100" class="form-control" value="{{$Pelicula->year}}">
            </div>

            <div class="form-group">
            <label for="title">Ator/a</label>
               <input type="text" name="aut" id="aut" class="form-control" value="{{$Pelicula->director}}">
            </div>

            <div class="form-group">
            <label for="title">Poster</label>
               <input type="text" name="img" id="img" class="form-control" value="{{$Pelicula->poster}}">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3" >{{$Pelicula->synopsis}}</textarea>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
               Modificar película
               </button>
            </div>

            </form>

@stop