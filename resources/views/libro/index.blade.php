@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>

                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Pages</th>
                            <th>Price</th>
                            <th>Editorial</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                    @foreach($libros as $libro)
                        <tr>
                            <td>{{$libro->title}}</td>
                            <td>{{$libro->pages}}</td>
                            <td>{{$libro->price}}</td>
                            <td>{{$libro->editorial}}</td>
                            <td>{{$libro->autor->name}}</td>
                            <td>
                                {!!Form::model($libro,array('route'=>['libro.destroy',$libro->id],'method'=>'DELETE'))!!}
                                    {{link_to_route('libro.edit','Update',[$libro->id],['class'=>'btn btn-primary'])}}

                                    {!!Form::button('Delete',['class'=>'btn btn-danger','type'=>'submit'])!!}                                  
                                {!!Form::close()!!}
                               

                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <a class="btn btn-danger" href="{{ url('/home') }}">Back</a>
            {{link_to_route('libro.create','Add New Book',null,['class'=>'btn btn-primary']) }}

        </div>
    </div>
</div>
@endsection
