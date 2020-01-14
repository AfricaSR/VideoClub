<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Notify;

class CatalogController extends Controller
{
    
    public function getShow($id) {

        $Pelicula = Movie::findOrFail($id);

        return view('catalog.show', array('Pelicula'=>$Pelicula));

    }

    public function getEdit($id){

        $Pelicula = Movie::findOrFail($id);

        return view('catalog.edit', array('id' => $id, 'Pelicula'=>$Pelicula));
        
    }

    public function getIndex() {

		$arrayPeliculas = Movie::all();
        
        return view('catalog.index', array('arrayPeliculas'=>$arrayPeliculas));

    }

    public function getCreate(){

        return view('catalog.create');

    }

    public function postCreate(Request $request){

        $p = new Movie;
        $p->title = $request->title;
        $p->year = $request->anio;
        $p->director = $request->aut;
        if ($request->has('img')) {

            $p->poster = $request->img;
            
        }
        $p->rented = false;
        $p->synopsis = $request->synopsis;
        $p->save();

        Notify::success('Has creado una nueva película!');

        return redirect('/catalog');

    }

    public function putEdit(Request $request, $id){

        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->title = $request->title;
        $p->year = $request->anio;
        $p->director = $request->aut;

        if ($request->has('img')) {

            $p->poster = $request->img;

        }

        
        $p->rented = false;
        $p->synopsis = $request->synopsis;
        $p->save();

        Notify::success('La película se ha editado correctamente!');

        $Pelicula = Movie::findOrFail($id);

        return view('catalog.show', array('Pelicula'=>$Pelicula));
        
    }

    public function putRent(Request $request, $id){

        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->rented = true;
        $p->save();

        Notify::info('Has alquilado esta Película');

        return redirect('/catalog');


    }

    public function putReturn(Request $request, $id){

        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->rented = false;
        $p->save();

        Notify::success('Gracias por devolver tu película');

        return redirect('/catalog');


    }

    public function deleteMovie(Request $request, $id){

        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->delete();

        Notify::warning('Película borrada correctamente');

        return redirect('/catalog');


    }

    

}
