@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                      <h3>Books</h3>
                    </div>
                    {!!Form::open(['route'=>'book.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
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
                                    @if($validate==($author->email))
                                       <span class="hidden">{{$isequal=true}}</span>
                                    @endif
                                @endforeach
                            </td>
                            @if($validate==($book->editorial->email)||$isequal)
                                    <td>
                                      <button class="edit-modal btn btn-primary"
                                              data-id="{{$book->id}}"
                                              data-title="{{$book->title}}"
                                              data-pages="{{$book->pages}}"
                                              data-price="{{$book->price}}"
                                              data-editorial="{{$book->edit_id}}"
                                              data-toggle="modal">
                                        Update
                                      </button>
                                    </td>
                                    <td>
                                        <button class="delete btn btn-danger"
                                                data-id="{{$book->id}}"
                                                data-title="{{$book->title}}"
                                                data-pages="{{$book->pages}}"
                                                data-price="{{$book->price}}"
                                                data-editorial="{{$book->edit_id}}">
                                          Delete
                                        </button>
                                    </td>
                                    <span class="hidden">{{$isequal=false}}</span>
                            @endif
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2||$role==1)
              <button type="button" class="create-modal btn btn-primary" data-toggle="modal">
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
  @if($role==2||$role==1)
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              {!!Form::open(array('route'=>'book.store'),['class'=>'form-horizontal','style'=>'display:none;'])!!}
              <form class="edit-form" role="form">
                  <div class="form-group">
                      <input type="text" name="id" id="id" value="" class="form-control" style="display:none"/>
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
                      <div class="form-group a">
                          {{ Form::text('edit_id', $user->id, ['class'=>'form-control','style'=>'display:none;']) }}
                      </div>
                      <div class="form-group">
                        <input type="text" name="id" id="edit_id" value="{{$user->id}}" class="form-control" style='display:none;'/>
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
                      <div class="form-group a">
                          {{ Form::text('edit_id', $editorial->id, ['class'=>'form-control','style'=>'display:none;']) }}
                      </div>
                      <div class="form-group">
                        <input type="text" name="id" id="edit_id" value="{{$editorial->id}}" class="form-control" style='display:none;'/>
                      </div>
                      <div class="form-group">
                          {!!Form::label('author_label','Authors')!!}<br>
                          <div class="checkbox">
                              <label>
                                  <input name='author_id[]' type="checkbox" value='{{$user->id}}' checked>{{$user->name}}
                              </label>
                          </div>
                      </div>
                  @endif
                  <div class="add-author form-group">
                      {!!Form::button('Save',['type'=>'submit','class'=>'btn btn-primary'])!!}
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
              </form>
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
          <div class="modal-footer">
						<button type="button" class="btn btn-primary actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class=""> Save</span>
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							<span class=""></span> Close
						</button>
					</div>
        </div>
      </div>
    </div>
  </div>
  @endif
<!--End Modals-->
<!--scripts for modals-->
<script>
$(document).on('click', '.edit-modal', function() {
  $('.modal-footer').show();
  $('#footer_action_button').text("Update");
  $('.modal-footer').show();
  $('.add-author').hide();
  $('.actionBtn').addClass('edit');
  $('.modal-title').text('Edit Author');
  $('.form-horizontal').hide();
  $('.edit-form').show();
  $('#id').val($(this).data('id'));
  $('#title').val($(this).data('title'));
  $('#pages').val($(this).data('pages'));
  $('#price').val($(this).data('price'));
  $('#myModal').modal('show');
});
$(document).on('click', '.create-modal', function() {
  $('.modal-footer').hide();
  $('.modal-title').text('Add Book');
  $('.add-author').show();
  $('.edit-form').hide();
  $('.form-horizontal').show();
  $('#title').val('');
  $('#pages').val('');
  $('#price').val('');
  $('#myModal').modal('show');
});
$(document).on('click', '.delete', function() {
  $.ajax({
        type: 'delete',
        url: '/api/v1/book/destroy',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $(this).data('id'),
            'title': $(this).data('title'),
            'pages': $(this).data('pages'),
            'price': $(this).data('price'),
            'edit_id': $(this).data('editorial'),
            'author_id':'99',
        },
        success: function() {
          location.reload();
        }
    });
});
$('.modal').on('click', '.edit', function() {
  var values = new Array();
  $.each($("input[name='author_id[]']:checked"), function() {
    values.push($(this).val());
  });
  $.ajax({
        type: 'put',
        url: '/api/v1/book/update',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#id").val(),
            'title': $('#title').val(),
            'pages': $('#pages').val(),
            'price': $('#price').val(),
            'edit_id': $('#edit_id').val(),
            'author_id':values,
        },
        success: function() {
          location.reload();
        }
    });
});
</script>
@endsection
