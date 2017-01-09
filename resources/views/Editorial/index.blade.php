@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                      <h3>Editorials</h3>
                    </div>
                    {!!Form::open(['route'=>'editorial.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
                        <div class="input-group">
                            {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Search an Editorial...','aria-describedby'=>'search'])!!}
                            <span class="input-group-addon" id="search"><button class="glyphicon glyphicon-search" style="border:none;"/></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Authors</th>
                            <th></th>
                        </tr>
                        @foreach($editorials as $edit)
                        <tr>
                            <td>{{$edit->name}}</td>
                            <td>{{$edit->email}}</td>
                            <td>
                            @foreach($edit->author as $author)
                              {{$author->name}}
                            @endforeach
                            </td>
                            @if($validate==($edit->email))
                                <td>
                                <button class="edit-modal btn btn-primary"
                                        data-id="{{$edit->id}}"
                                        data-name="{{$edit->name}}"
                                        data-toggle="modal">
                                  Update
                                </button>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
    </div>
</div>
<!--Modals-->
  @if($role==2)
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Update Editorial</h4>
        </div>
        <div class="modal-body">
          <form class="" role="form">
            <div class="form-group">
              <label>id</label>
              <input type="text" name="id" id="id" value="" class="form-control" readonly/>
            </div>
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" id="name" value="" class="form-control"/>
            </div>
          </form>
          <div class="modal-footer">
						<button type="button" class="edit btn btn-primary actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class=""> Update</span>
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
  $('#id').val($(this).data('id'));
  $('#name').val($(this).data('name'));
  $('#myModal').modal('show');
});

$('.modal').on('click', '.edit', function() {
  $.ajax({
          type: 'put',
          url: '/api/v1/editorial/update',
          data: {
              '_token': $('input[name=_token]').val(),
              'id': $("#id").val(),
              'name': $("#name").val(),

          },
          success: function() {
            location.reload();
          }
      });
});
</script>
@endsection
