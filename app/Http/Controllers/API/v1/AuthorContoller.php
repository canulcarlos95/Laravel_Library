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
    }

    public function update(AutorRequest $req)
    {
      $data = Autor::find ( $req->id );
      $data->name = $req->name;
      $data->country = $req->country;
      $data->edit_id = $req->edit_id;
      $data->save ();
    }

    public function destroy(AutorRequest $request)
    {
        $author = Autor::find($request->id);
        $author->book()->detach();
        DB::table('users')
            ->where('email', $author->email)
            ->delete();
        $author->delete();
    }
}
