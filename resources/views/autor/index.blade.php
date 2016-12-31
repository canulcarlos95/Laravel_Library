@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>
                <div class="panel-body">
                    {!!Form::open(['route'=>'autor.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
                        <div class="input-group">
                            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Search an author...','aria-describedby'=>'search'])!!}
                            <span class="input-group-addon" id="search"><button style="border:none;"><span class="glyphicon glyphicon-search"/></button></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Author Name</th>
                            <th>Country</th>
                            <th>Editorial</th>
                            <th></th>
                        </tr>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{$author->name}}</td>
                            <td>{{$author->country}}</td>
                            <td>{{$author->editorial->name}}</td>
                            <td>
                            @if($validate==($author->name)||$validate==($author->editorial->name))
                                <button class="open-AddAuthorDialog edit-modal btn btn-primary"
                                        data-id="{{$author->id}}"
                                        data-name="{{$author->name}}"
                                        data-country="{{$author->country}}"
                                        data-editorial="{{$author->edit_id}}"
                                        data-toggle="modal"
                                        data-target="#Edit">
                                  Edit
                                </button>
                                {{link_to_route('autor.edit','Update',[$author->id],['class'=>'btn btn-primary'])}}
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Create">
                  Add author
                </button>
            @endif
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
    </div>
</div>
<!--Modals-->
<!--Modal create author-->
  @if($role==2)
  <div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Add New Author</h4>
        </div>
        <div class="modal-body">
                <div class="panel-body">
                    {!!Form::open(array('route'=>'autor.store'))!!}
                        <div class="form-group">
                            {!!Form::label('name','Author Name')!!}
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('country','Country')!!}
                            @include('autor/countries', ['default' => null])
                        </div>
                        <div class="form-group">
                            {!!Form::label('edit_id','Editorial')!!}
                            {{ Form::select('edit_id',[$user->id=>$user->name], null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                        </div>
                        <div class="form-group">
                            {!!Form::button('Save',['type'=>'submit','class'=>'btn btn-primary'])!!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    {!!Form::close()!!}
                </div>
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
<!--End Modal Create Author-->
<!--Modal Edit author-->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Author</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body">

            {!!Form::model($autor,array('route'=>['autor.update',$autor->id],'method'=>'PUT'))!!}
                <div class="form-group">
                    <input type="text" name="author_id" id="author_id" value="" class="form-control"/>
                    {!!Form::label('name','Author Name')!!}
                    {!!Form::text('name',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('country','Country')!!}
                    @include('autor/countries', ['default' => null])
                </div>
                @if($role=='2')
                    <div class="form-group">
                        {!!Form::label('edit_id','Editorial')!!}
                        {{ Form::select('edit_id', [$user->id=>$user->name], null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                    </div>
                @elseif($role=='1')
                    <div class="form-group">
                        {!!Form::label('edit_id','Editorial')!!}
                        {{ Form::select('edit_id', $edit, null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                    </div>
                @endif
                <div class="form-group">
                    {!!Form::button('Save',['type'=>'submit','class'=>'btn btn-primary'])!!}
                    <a class="btn btn-danger" href="{{ url('/autor') }}">Cancel</a>
                </div>
            {!!Form::close()!!}
        </div>
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
</div>
<!--End Modal Edit Author-->
@endsection
