<?php

namespace Library\Http\Controllers;
use DB;
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
        $books=Libro::Search($request->title)->paginate(30);
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
            $authorname = Autor::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('autors')->where('id', $authorname)->first();
            $editorial = DB::table('editorials')->where('id', $user->edit_id)->first();
            $role = Auth::user()->role_id;
            return view('libro.create',compact('libro','role','user','editorial'));
        }
        $authorname = Autor::pluck('name','id');
        $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
        $user = DB::table('editorials')->where('id', $aux)->first();
        $role = Auth::user()->role_id;
        return view('libro.create',compact('libro','authorname','user','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibroRequest $request)
    {
        $created = libro::create($request->all());
        $book = libro::find($created->id);
        $book->author()->attach($request->author_id);
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
        if((Auth::user()->role_id)=='3'&&Auth::user()->name!=($libro->autor->name)){
            return view('errors.error');
        }
        if(Auth::user()->role_id=='2'){
            $authorname = Autor::pluck('name','id');
            $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('editorials')->where('id', $aux)->first();
            $role = Auth::user()->role_id;
            return view('libro.edit',compact('libro','authorname','user','role'));
        }
        $authorname = Autor::pluck('name','id')->search(Auth::user()->name);
        $user = DB::table('autors')->where('id', $authorname)->first();
        $editorial = DB::table('editorials')->where('id', $user->edit_id)->first();
        $role = Auth::user()->role_id;
        return view('libro.edit',compact('libro','role','user','editorial'));
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
        $book = libro::find($libro->id);
        $book->author()->attach($request->author_id);
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
        $book = libro::find($libro->id);
        $book->author()->detach();
        $libro->delete();
        return redirect()->route('libro.index');
    }
}
