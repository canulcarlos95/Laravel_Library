<?php

namespace Library\Http\Controllers;
use Library\Models\Autor;
use Library\Models\User;
use Library\Models\Role;
use Illuminate\Http\Request;
use Library\Http\Requests\AutorRequest;
use Illuminate\Support\Facades\Auth;

class AutorContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role_id;
        $autores = Autor::all();
        return view('autor.index',compact('autores','role'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if((Auth::user()->role_id)=='2'){
            return view('autor.create');
        }
        return view('errors.error');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutorRequest $request)
    {
        autor::create($request->all());
        return redirect()->route('autor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Autor $autor)
    {
        if((Auth::user()->role_id)=='2'){
            return view('autor.edit',compact('autor'));
        }
        return view('errors.error');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AutorRequest $request, Autor $autor)
    {
        $autor->update($request->all());
        return redirect()->route('autor.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('autor.index');
    }
}
