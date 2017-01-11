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
            $validate = Auth::user()->email;
            $isequal=false;
            $authorname = Autor::pluck('email','id')->search(Auth::user()->email);
            $user = DB::table('autors')->where('id', $authorname)->first();
            $editorial = DB::table('editorials')->where('id', $user->edit_id)->first();
            $role = Auth::user()->role_id;
            return view('book.index',compact('books','role','isequal','validate','user','editorial'));
        }
        $books=Libro::Search($request->title)->paginate(30);
        $role = Auth::user()->role_id;
        $validate = Auth::user()->email;
        $isequal=false;
        $aux =Editorial::pluck('email','id')->search(Auth::user()->email);
        $user = DB::table('editorials')->where('id', $aux)->first();
        $name = DB::table('autors')->where('edit_id', $aux)->get();
        $role = Auth::user()->role_id;
        return view('book.index',compact('books','role','isequal','validate','user','name'));
    }

}
