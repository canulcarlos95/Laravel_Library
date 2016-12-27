@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>

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
@endsection
