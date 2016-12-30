@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>

                <div class="panel-body">
                    {!!Form::open(['route'=>'libro.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
                        <div class="input-group">
                            {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Search a Book...','aria-describedby'=>'search'])!!}
                            <span class="input-group-addon" id="search"><button class="glyphicon glyphicon-search" style="border:none;"/></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Pages</th>
                            <th>Price</th>
                            <th>Editorial</th>
                            <th>Authors</th>
                            <th></th>
                        </tr>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>{{$book->pages}}</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->editorial->name}}</td>
                            <td>
                                @foreach($book->author as $author)
                                    {{$author->name}},
                                    @if($validate==($author->name))
                                       <span class="hidden">{{$isequal=true}}</span>
                                    @endif
                                @endforeach
                            </td>
                            @if($validate==($book->editorial->name)||$isequal||$validate==($author->name))
                                    {!!Form::model($book,array('route'=>['libro.destroy',$book->id],'method'=>'DELETE'))!!}
                                        <td>
                                            {!!Form::button('Delete',['class'=>'btn btn-danger','type'=>'submit'])!!}
                                        </td>
                                        <td>
                                            {{link_to_route('libro.edit','Update',[$book->id],['class'=>'btn btn-primary'])}}
                                        </td>
                                    {!!Form::close()!!}
                                    <span class="hidden">{{$isequal=false}}</span>
                            @endif
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2||$role==1)
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Create">
                Add New Book
              </button>
            @endif
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
            <br>
            <br>
        </div>
    </div>
</div>
<!--Modals-->
<!--Modal create Book-->
  @if($role==2||$role==1)
  <div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Add New Book</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
              {!!Form::open(array('route'=>'libro.store'))!!}
                  <div class="form-group">
                      {!!Form::label('title','Title')!!}
                      {!!Form::text('title',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                      {!!Form::label('pages','Pages')!!}
                      {!!Form::text('pages',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                      {!!Form::label('price','Price')!!}
                      {!!Form::text('price',null,['class'=>'form-control'])!!}
                  </div>
                  @if($role=='2')
                      <div class="form-group">
                          {!!Form::label('edit_id','Editorial')!!}
                          {{ Form::select('edit_id', [$user->id=>$user->name], null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                      </div>
                      <div class="form-group">
                      {!!Form::label('author','Authors')!!}
                          <div class="checkbox">
                              @foreach($name as $authname)
                                  <label>
                                    <input name='author_id[]' type="checkbox" value='{{$authname->id}}'>{{$authname->name}}

                                  </label>
                              @endforeach
                          </div>
                      </div>
                  @elseif($role=='1')
                      <div class="form-group">
                          {!!Form::label('edit_id','Editorial')!!}
                          {{ Form::select('edit_id', [$editorial->id=>$editorial->name], null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                      </div>
                      <div class="form-group">
                          {!!Form::label('author_label','Authors')!!}<br>
                          {{Form::checkbox('author_id',$user->id)}}
                          {!!Form::label('author_id',$user->name)!!}
                      </div>
                  @endif
                  <div class="form-group">
                      {!!Form::button('Save',['type'=>'submit','class'=>'btn btn-primary'])!!}
                      <a class="btn btn-danger" href="{{ url('/libro') }}">Cancel</a>
                  </div>
              {!!Form::close()!!}
          </div>
          @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endif
<!--End Modal Create Book-->
@endsection
