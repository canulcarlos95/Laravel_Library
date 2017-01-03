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
                        <tr class="item{{$author->id}}">
                            <td>{{$author->name}}</td>
                            <td>{{$author->country}}</td>
                            <td>{{$author->editorial->name}}</td>
                            <td>
                            @if($validate==($author->name)||$validate==($author->editorial->name))
                                <button class="edit-modal btn btn-primary"
                                        data-id="{{$author->id}}"
                                        data-name="{{$author->name}}"
                                        data-country="{{$author->country}}"
                                        data-editorial="{{$author->edit_id}}"
                                        data-toggle="modal">
                                  Edit
                                </button>
                                {{link_to_route('autor.index','Update',[$author->id],['class'=>'btn btn-primary'])}}
                            @endif
                            </td>
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
              {!!Form::open(array('route'=>'autor.store'),['class'=>'form-horizontal','style'=>'display:none;'])!!}
              <form class="edit-form" role="form">
                <div class="form-group">
                    <input type="text" name="id" id="author_id" value="" class="form-control"/>
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
                        {{ Form::text('edit_id', $user->id, ['class'=>'form-control']) }}
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
  </div>
</div>
<!--End Modals-->
<!--scripts for modals-->
<script>
$(document).on('click', '.edit-modal', function() {
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
        type: 'post',
        url: '/update',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#author_id").val(),
            'name': $('#name').val(),
            'country': $('#country').val(),
            'edit_id': $('#edit_id').val()

        },
        success: function(data) {
            $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>"+data.name+"</td><td>"+data.country+"</td><td>{{$author->editorial->name}}</td></tr>");
        }
    });
});
</script>
@endsection
