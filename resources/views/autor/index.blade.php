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
                            <span class="input-group-addon" id="search"><button style="border:none;">Search</button></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Author Id</th>
                            <th>Author Name</th>
                            <th>Country</th>
                            <th></th>
                        </tr>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{$author->id}}</td>
                            <td>{{$author->name}}</td>
                            <td>{{$author->country}}</td>
                            <td>
                            @if($role==2||$validate==($author->name))
                                {{link_to_route('autor.edit','Update',[$author->id],['class'=>'btn btn-primary'])}}
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2)
                {{link_to_route('autor.create','Add New Author',null,['class'=>'btn btn-primary']) }}
            @endif
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
    </div>
</div>
@endsection
