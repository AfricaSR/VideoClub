<?php

namespace App\Http\Controllers;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Movie;
use App\Review;
use App\Category;
use App\Favourite;
use Notify;

class CatalogController extends Controller
{
    
    public function getShow($id) {

        $Pelicula = Movie::findOrFail($id);

        $Reviews = Review::where('movie_id', $id)->get();

        $Fav = false;

        if ((Favourite::where('movie_id', $id)->where('user_id', Auth::id()))->first()){

            $Fav = true;

        }

        return view('catalog.show', array('Pelicula'=>$Pelicula, 'Reviews'=>$Reviews, 'Fav'=>$Fav));

    }

    public function getEdit($id){

        $Pelicula = Movie::findOrFail($id);

        $Category = Category::all();

        return view('catalog.edit', array('id' => $id, 'Pelicula'=>$Pelicula, 'Category'=>$Category));
        
    }

    public function getIndex() {

		$arrayPeliculas = Movie::all();
        
        return view('catalog.index', array('arrayPeliculas'=>$arrayPeliculas));

    }

    public function getCreate(){

        $c = Category::all();

        return view('catalog.create', array('Category'=>$c));

    }

    public function postCreate(Request $request){

        $p = new Movie;
        $p->title = $request->title;
        $p->year = $request->anio;
        $p->director = $request->aut;
        $p->category_id = $request->Category;

        if ($request->has('img')) {

            $p->poster = $request->img;
            
        }

        if ($request->has('trailer')) {

            $p->trailer = $request->trailer;
            
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

        if ($request->has('trailer')) {

            $p->trailer = $request->trailer;
            
        }
        $p->rented = false;
        $p->synopsis = $request->synopsis;
        $p->save();

        Notify::success('La película se ha editado correctamente!');

        $Pelicula = Movie::findOrFail($id);

        $Reviews = Review::where('movie_id', $id)->get();

        $Fav = false;

        if ((Favourite::where('movie_id', $id)->where('user_id', Auth::id()))->first()){

            $Fav = true;

        }

        return view('catalog.show', array('Pelicula'=>$Pelicula, 'Reviews'=>$Reviews, 'Fav'=>$Fav));
        
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

    public function postReview(Request $request, $id){

        $user = Auth::id();
        $Pelicula = Movie::findOrFail($id);
        $r = new Review;
        $r->title = $request->title;
        $r->review = $request->review;
        $r->stars = $request->stars;
        $r->user_id = $user;
        $r->movie_id = $Pelicula->id;
        $r->save();

        $Reviews = Review::where('movie_id', $Pelicula->id)->get();

        Notify::success('Gracias por darnos tu opinión!');

        $Fav = false;

        if ((Favourite::where('movie_id', $id)->where('user_id', Auth::id()))->first()){

            $Fav = true;

        }

        return view('catalog.show', array('Pelicula'=>$Pelicula, 'Reviews'=>$Reviews, 'Fav'=>$Fav));

    }

    function search(Request $request){

        $q = $request->qry;

        $Peliculas = Movie::where('title', 'LIKE','%'.$q.'%')->orWhere('director','LIKE','%'.$q.'%')->get();

        return view('catalog.index', array('arrayPeliculas'=>$Peliculas));

    }

}
