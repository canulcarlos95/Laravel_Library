@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                      <h3>Authors</h3>
                    </div>
                    {!!Form::open(['route'=>'autor.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
                        <div class="input-group">
                            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Search an author...','aria-describedby'=>'search'])!!}
                            <span class="input-group-addon" id="search"><button style="border:none;"><span class="glyphicon glyphicon-search"/></button></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Author Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Editorial</th>
                            <th></th>
                        </tr>
                    @foreach($authors as $author)
                        <tr class="item{{$author->id}}">
                            <td>{{$author->name}}</td>
                            <td>{{$author->email}}</td>
                            <td>{{$author->country}}</td>
                            <td>{{$author->editorial->name}}</td>
                            @if($validate==($author->email)||$validate==($author->editorial->email))
                                <td>
                                <button class="edit-modal btn btn-primary"
                                        data-id="{{$author->id}}"
                                        data-name="{{$author->name}}"
                                        data-country="{{$author->country}}"
                                        data-toggle="modal">
                                  Update
                                </button>
                                </td>
                                @if($validate==($author->editorial->email))
                                  {!!Form::model($author,array('route'=>['author.delete',$author->id],'method'=>'DELETE'))!!}
                                      <td>
                                          {!!Form::button('Delete',['class'=>'btn btn-danger','type'=>'submit'])!!}
                                      </td>
                                  {!!Form::close()!!}
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2)
                <button type="button" class="btn btn-primary create-modal" data-toggle="modal">
                  Add author
                </button>
            @endif
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
    </div>
</div>
<!--Modals-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              {!!Form::open(array('route'=>'author.add'),['class'=>'form-horizontal','style'=>'display:none;'])!!}
              <form class="edit-form" role="form">
                <div class="form-group">
                    <input type="text" name="id" id="author_id" value="" class="form-control" style='display:none;'/>
                    {!!Form::label('name','Author Name')!!}
                    {!!Form::text('name',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('country','Country')!!}
                    @include('autor/countries', ['default' => null])
                </div>
                @if($role=='2')
                    <div class="form-group a">
                        {{ Form::text('edit_id', $user->id, ['class'=>'form-control','style'=>'display:none;']) }}
                    </div>
                  <div class="form-group b">
                    <input type="text" name="id" id="edit_id" value="{{$user->id}}" class="form-control" style='display:none;'/>
                  </div>
                @elseif($role=='1')
                    <div class="form-group">
                        {!!Form::label('edit_id','Editorial')!!}
                        {{ Form::select('edit_id', $edit, null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
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
						<button type="button" class="btn btn-primary actionBtn edit" data-dismiss="modal">
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
  </div>
</div>
<!--End Modals-->
<!--scripts for modals-->
<script>
$(document).on('click', '.edit-modal', function() {
  $('.modal-footer').show();
  $('#footer_action_button').text("Update");
  $('.add-author').hide();
  $('.actionBtn').addClass('edit');
  $('.modal-title').text('Edit Author');
  $('.form-horizontal').hide();
  $('.edit-form').show();
  $('#author_id').val($(this).data('id'));
  $('#name').val($(this).data('name'));
  $('#country').val($(this).data('country'));
  $('#myModal').modal('show');
});
$(document).on('click', '.create-modal', function() {
  $('.modal-footer').hide();
  $('.modal-title').text('Add Author');
  $('.b').hide();
  $('.a').show();
  $('.add-author').show();
  $('.edit-form').hide();
  $('.form-horizontal').show();
  $('#author_id').val('');
  $('#name').val('');
  $('#country').val('');
  $('#myModal').modal('show');
});
$('.modal').on('click', '.edit', function() {
  $.ajax({
        type: 'put',
        url: '/api/v1/author/update',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#author_id").val(),
            'name': $('#name').val(),
            'country': $('#country').val(),
            'edit_id': $('#edit_id').val()

        },
        success: function() {
            location.reload();
        }
    });
});
</script>
@endsection
