<?php

namespace Library\Http\Controllers\API\v1;
use Library\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Library\Http\Requests\EditRequest;

class EditorialController
{
  public function update(EditRequest $req)
  {
    $data = Editorial::find ( $req->id );
    $data->name = $req->name;
    $data->save ();
    return response ()->json ( $data );
  }
  
}
