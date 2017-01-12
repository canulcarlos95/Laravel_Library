<?php

namespace Library\Http\Controllers\API\v1;
use DB;
use Library\Models\Libro;
use Library\Models\Autor;
use Library\Models\Editorial;
use Illuminate\Http\Request;
use Library\Http\Requests\LibroRequest;
use Illuminate\Support\Facades\Auth;
class BookContoller
{
    public function store(LibroRequest $request)
    {
        $created = libro::create($request->all());
        $myCheckboxes = $request->input('author_id');
        $book = libro::find($created->id);
        $book->author()->attach($myCheckboxes);
        return redirect()->route('book.index');
    }

    public function update(LibroRequest $request)
    {
      $book = libro::find($request->id);
      $data = Libro::find ( $request->id );
      $book->author()->detach();
      $data->author()->attach($request->author_id);
      $data->title = $request->title;
      $data->pages = $request->pages;
      $data->price = $request->price;
      $data->edit_id = $request->edit_id;
      $data->save ();
    }

    public function destroy(LibroRequest $request)
    {
        $book = libro::find($request->id);
        $book->author()->detach();
        $book->delete();
    }
}
