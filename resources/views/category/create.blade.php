@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Nueva Categoría
         </div>
         <div class="card-body" style="padding:30px">

            <form method="POST">

            {{ csrf_field() }}
            {{method_field('POST')}}

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
               <label for="synopsis">Descripción</label>
               <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>

            
            <div class="form-group mb-3 mt-3">
               <label for="synopsis">Para Adultos</label>
               <select class="custom-select" id="adult" name="adult">
                  <option selected value="0">No</option>
                  <option value="1">Sí</option>
               </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir Categorñia
               </button>
            </div>

            </form>

         </div>
      </div>
   </div>
</div>


@stop