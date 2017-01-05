<?php

namespace Library\Http\Controllers;
use DB;
use Library\Models\Autor;
use Library\Models\User;
use Library\Models\Editorial;
use Library\Models\Role;
use Illuminate\Http\Request;
use Library\Http\Requests\AutorRequest;
use Illuminate\Support\Facades\Auth;

class AutorContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Autor $autor)
    {
        $authors=Autor::Search($request->name)->paginate(10);
        $role = Auth::user()->role_id;
        $validate = Auth::user()->name;
        $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
        $user = DB::table('editorials')->where('id', $aux)->first();
        $edit=Editorial::pluck('name','id');
        return view('autor.index',compact('authors','role','validate','user','autor','edit'));

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
        return redirect()->route('author.index');
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

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AutorRequest $req)
    {
      $data = Autor::find ( $req->id );
      $data->name = $req->name;
      $data->country = $req->country;
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
    public function destroy(Autor $autor)
    {
      $auth = Autor::find($autor->id);
      if($auth->book()->detach()){
        $autor->delete();
        return redirect()->route('author.index');
      }
      return view('errors.503');
    }
}
