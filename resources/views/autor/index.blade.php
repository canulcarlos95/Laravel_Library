@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>

                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Author Id</th>
                            <th>Author Name</th>
                            <th>Country</th>
                            <th></th>
                        </tr>
                    @foreach($autores as $autor)
                        <tr>
                            <td>{{$autor->id}}</td>
                            <td>{{$autor->name}}</td>
                            <td>{{$autor->country}}</td>
                            <td>
                                {{link_to_route('autor.edit','Update',[$autor->id],['class'=>'btn btn-primary'])}}
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <a class="btn btn-danger" href="{{ url('/home') }}">Back</a>
            {{link_to_route('autor.create','Add New Author',null,['class'=>'btn btn-primary']) }}
        </div>
    </div>
</div>
@endsection
