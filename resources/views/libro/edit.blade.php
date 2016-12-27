@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Books</div>

                <div class="panel-body">
                    {!!Form::model($libro,array('route'=>['libro.update',$libro->id],'method'=>'PUT'))!!}
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
                                {!!Form::label('author_id','Author')!!}
                                {{ Form::select('author_id', [], null,['placeholder' => 'Select an author...','class'=>'form-control']) }}
                            </div>
                        @elseif($role=='1')
                            <div class="form-group">
                                {!!Form::label('edit_id','Editorial')!!}
                                {{ Form::select('edit_id', [$editorial->id=>$editorial->name], null,['placeholder' => 'Select an editorial...','class'=>'form-control']) }}
                            </div>
                            <div class="form-group">
                                {!!Form::label('author_id','Author')!!}
                                {{ Form::select('author_id', [$user->id=>$user->name], null,['placeholder' => 'Select an author...','class'=>'form-control']) }}
                            </div>
                        @endif
                        <div class="form-group">
                            {!!Form::button('Save',['type'=>'submit','class'=>'btn btn-primary'])!!}
                            <a class="btn btn-danger" href="{{ url('/libro') }}">Cancel</a>
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
@endsection
