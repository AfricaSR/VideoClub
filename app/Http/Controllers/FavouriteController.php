<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Movie;
use App\Review;
use App\Favourite;
use Notify;
use DB;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fav = Favourite::where('user_id', Auth::id())->get();

        $arrayPeliculas = [];

        foreach($fav as $f){
            array_push($arrayPeliculas, Movie::where('id', $f->movie_id)->get());
        }
        
        
        return view('catalog.favourites', array('arrayPeliculas'=>$arrayPeliculas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function getFavourite($id){

        $f = new Favourite;
        $f->user_id = Auth::id();
        $f->movie_id = $id;
        $f->save();

        Notify::success('Película agregada a favoritos!');

        return redirect('/catalog/show/'.$id);

    }

    public function ranking()
    {
        /*
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

            SELECT m.id, m.title, m.poster, count(f.movie_id) as votes 
            from movies m 
            JOIN favourites f 
            on m.id = f.movie_id 
            GROUP BY movie_id 
            ORDER BY votes DESC
                    $ranking = DB::table('movies')
                    ->join('favourites', 'movies.id', '=', 'favourites.movie_id')
                    ->select('favourites.movie_id')->count();
        */

        $ranking = DB::table('movies')
            ->join('favourites', 'movies.id', '=', 'favourites.movie_id')
            ->select('movies.id as id', 'movies.title as title','movies.poster as poster', DB::raw("count(favourites.movie_id) as count"))
            ->groupBy('movies.id')
            ->orderBy('count', 'desc')
            ->get();



        return view('catalog.ranking', array('Favourites'=>$ranking));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFavourite($id)
    {
        $fav = Favourite::where('movie_id', $id)->where('user_id', Auth::id())->get();

        $f = new Favourite;

        $d = $f->findOrFail($fav[0]->id);

        $d->delete();

        Notify::warning('Has eliminado la película de favoritos');

        return redirect('/catalog/show/'.$id);

    }
}
