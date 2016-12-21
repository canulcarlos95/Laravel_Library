@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-danger">
                You don´t have permissions to access
            </div>
        <div class="form-group">
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
        </div>
    </div>
</div>
@endsection
