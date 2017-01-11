<?php

namespace Library\Http\Controllers\API\v1;

use DB;
use Library\Models\Autor;
use Library\Models\User;
use Library\Models\Editorial;
use Library\Models\Role;
use Illuminate\Http\Request;
use Library\Http\Requests\AutorRequest;
use Illuminate\Support\Facades\Auth;

class AuthorContoller
{
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
    public function store(AutorRequest $request)
    {
      $email=$request->name.substr($request->country,0,3).'@library.com';
      if(User::create([
          'name' => $request->name,
          'email' => $email,
          'password' => bcrypt('123456'),
          'role_id'=>'1',
      ])){
        autor::create([
        'name' => $request->name,
        'email' => $email,
        'country' => $request->country,
        'edit_id' => $request->edit_id,
        ]);
        return redirect()->route('author.index');
      }
        return view('errors.503');
    }

    public function update(AutorRequest $req)
    {
      $data = Autor::find ( $req->id );
      $data->name = $req->name;
      $data->country = $req->country;
      $data->edit_id = $req->edit_id;
      $data->save ();
      return response ()->json ( $data );
    }

    public function destroy(Autor $autor)
    {
      if(DB::table('book_authors')->where('author_id', '=', $autor->id)->delete()){
        DB::table('users')
            ->where('email', $autor->email)
            ->update(['role_id' => 3]);
        $autor->delete();
        return redirect()->route('author.index');
      }
      DB::table('users')
          ->where('email', $autor->email)
          ->update(['role_id' => 3]);
      $autor->delete();
      return redirect()->route('author.index');
    }
}
