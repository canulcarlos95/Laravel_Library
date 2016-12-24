<?php

namespace Library\Http\Controllers;
use Library\Models\Libro;
use Library\Models\Autor;
use Library\Models\Editorial;
use Illuminate\Http\Request;
use Library\Http\Requests\LibroRequest;
use Illuminate\Support\Facades\Auth;
class LibroContoller extends Controller
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
    public function index(Request $request)
    {
        $books=Libro::Search($request->title)->paginate(10);
        $role = Auth::user()->role_id;
        $validate = Auth::user()->name;
        return view('libro.index',compact('books','role','validate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if((Auth::user()->role_id)=='3'){
            return view('errors.error');
        }
        if((Auth::user()->role_id)=='1'){
            $editorial = Editorial::pluck('name','id');
            $authorname = Autor::pluck('name','id');
            return view('libro.create',compact('authorname','editorial'));
        }
        $editorial = Editorial::pluck('name','id');
        $authorname = Autor::pluck('name','id');
        return view('libro.create',compact('authorname','editorial'));//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibroRequest $request)
    {
        libro::create($request->all());
        return redirect()->route('libro.index');
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
    public function edit(Libro $libro)
    {
        if((Auth::user()->role_id)=='3'||Auth::user()->name!=($libro->autor->name)){
            return view('errors.error');
        }
        $authorname = Autor::pluck('name','id');
        $edit = Editorial::pluck('name','id');
        return view('libro.edit',compact('libro','authorname','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibroRequest $request, Libro $libro)
    {
        $libro->update($request->all());
        return redirect()->route('libro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libro.index');
    }
}
