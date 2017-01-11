<?php

namespace Library\Http\Controllers;
use Library\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Library\Http\Requests\EditRequest;

class EditorialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $editorials = Editorial::Search($request->name)->paginate(10);
    $role = Auth::user()->role_id;
    $validate = Auth::user()->email;
    return view('editorial.index',compact('role','editorials','validate'));
  }
  
}
