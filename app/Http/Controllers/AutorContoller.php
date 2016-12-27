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
        $authors=Autor::Search($request->name)->paginate(10);
        $role = Auth::user()->role_id;
        $validate = Auth::user()->name;
        return view('autor.index',compact('authors','role','validate'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if((Auth::user()->role_id)=='2'){
            $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('editorials')->where('id', $aux)->first();
            return view('autor.create',compact('user'));
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
            $aux =Editorial::pluck('name','id')->search(Auth::user()->name);
            $user = DB::table('editorials')->where('id', $aux)->first();
            $role = Auth::user()->role_id;
            return view('autor.edit',compact('autor','user','role'));
        }
        elseif(Auth::user()->name==$autor->name){
            $edit=Editorial::pluck('name','id');
            $role = Auth::user()->role_id;
            return view('autor.edit',compact('autor','edit','role'));
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
