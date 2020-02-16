@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
         Modificar Categoría
         </div>
         <div class="card-body" style="padding:30px">

            <form method="POST" action="{{action('CategoryController@update', $Category->id)}}" >
            
            {{ csrf_field() }}
            {{method_field('PUT')}}

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control" value="{{$Category->title}}">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="description" id="description" class="form-control" rows="3" >{{$Category->description}}</textarea>
            </div>

            @if ($Category->adult == 0)
            <div class="form-group mb-3 mt-3">
               <label for="synopsis">Para Adultos</label>
               <select class="custom-select" id="adult" name="adult">
                  <option selected value="0">No</option>
                  <option value="1">Sí</option>
               </select>
            </div>
            @else
            <div class="form-group mb-3 mt-3">
               <label for="synopsis">Para Adultos</label>
               <select class="custom-select" id="adult" name="adult">
                  <option selected value="1">Sí</option>
                  <option value="0">No</option>
               </select>
            </div>
            @endif
            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
               Modificar Categoría
               </button>
            </div>

            </form>

@stop