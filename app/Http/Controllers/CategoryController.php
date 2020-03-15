<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
// use Notify;
use App\Movie;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories = Category::all();

        return view('category.index', array('Categories'=>$Categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $c = new Category;
        $c->title = $request->title;
        $c->description = $request->description;
        $c->adult = $request->adult;
        $c->save();

        // // Notifysuccess('Has creado una nueva Categoría!');

        return redirect('/category');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c = Category::findOrFail($id);

        $Peliculas = Movie::where('category_id', $c->id)->get();

        return view('category.show', array('Category'=>$c, 'Peliculas'=>$Peliculas));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Category::findOrFail($id);

        return view('category.edit', array('id' => $id, 'Category'=>$c));
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
        $cat = new Category;
        $c = $cat -> findOrFail($id);
        $c->title = $request->title;
        $c->description = $request->description;
        $c->adult = $request->adult;
        $c->save();

        // // Notifysuccess('La categoría se ha editado correctamente!');

        $Category = Category::findOrFail($id);

        $Peliculas = Movie::where('category_id', $c->id)->get();

        return view('category.show', array('Category'=>$Category, 'Peliculas'=>$Peliculas));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = new Category;
        $c = $cat -> findOrFail($id);
        $c->delete();

        // // Notifywarning('Categoría borrada correctamente');

        return redirect('/category');
    }
}
