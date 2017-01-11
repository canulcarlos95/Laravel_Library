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
        $validate = Auth::user()->email;
        $aux =Editorial::pluck('email','id')->search(Auth::user()->email);
        $user = DB::table('editorials')->where('id', $aux)->first();
        $edit=Editorial::pluck('name','id');
        return view('author.index',compact('authors','role','validate','user','edit'));

    }
}
