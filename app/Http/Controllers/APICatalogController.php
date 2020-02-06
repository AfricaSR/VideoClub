<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Movie::all() );
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Pelicula = Movie::findOrFail($id);
        return response()->json( $Pelicula );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Movie;
        $p->title = $request->title;
        $p->year = $request->anio;
        $p->director = $request->aut;
        $p->poster = $request->img;
        $p->rented = false;
        $p->synopsis = $request->synopsis;
        $p->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->title = $request->title;
        $p->year = $request->anio;
        $p->director = $request->aut;
        $p->poster = $request->img;     
        $p->synopsis = $request->synopsis;
        $p->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m = new Movie;
        $p = $m -> findOrFail($id);
        $p->delete();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putRent($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false,
                            'msg' => 'La película se ha marcado como alquilada' ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putReturn($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
                            'msg' => 'La película se ha marcado como disponible' ] );
    }


}
