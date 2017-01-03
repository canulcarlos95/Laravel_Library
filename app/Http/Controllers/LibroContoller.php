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
        if((Auth::user()->role_id)=='1'){
            $books=Libro::Search($request->title)->paginate(30);
            $role = Auth::user()->role_id;
            $validate = Auth::user()->name;
            $isequal=false;
            $authorname = Autor::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('autors')->where('id', $authorname)->first();
            $editorial = DB::table('editorials')->where('id', $user->edit_id)->first();
            $role = Auth::user()->role_id;
            return view('libro.index',compact('books','role','isequal','validate','user','editorial'));
        }
        $books=Libro::Search($request->title)->paginate(30);
        $role = Auth::user()->role_id;
        $validate = Auth::user()->name;
        $isequal=false;
        $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
        $user = DB::table('editorials')->where('id', $aux)->first();
        $name = DB::table('autors')->where('edit_id', $aux)->get();
        $role = Auth::user()->role_id;
        return view('libro.index',compact('books','role','isequal','validate','user','name'));
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
        $myCheckboxes = $request->input('author_id');
        $book = libro::find($created->id);
        $book->author()->attach($myCheckboxes);
        return redirect()->route('libro.index');
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
            $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('editorials')->where('id', $aux)->first();
            $name = DB::table('autors')->where('edit_id', $aux)->get();
            $role = Auth::user()->role_id;
            return view('libro.edit',compact('libro','name','user','role'));
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
    public function update(LibroRequest $req)
    {
      $data = Libro::find ( $req->id );
      $data->title = $req->title;
      $data->pages = $req->pages;
      $data->price = $req->price;
      $data->edit_id = $req->edit_id;
      $data->save ();
      return response ()->json ( $data );
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
