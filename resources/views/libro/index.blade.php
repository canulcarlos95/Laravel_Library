@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>

                <div class="panel-body">
                    {!!Form::open(['route'=>'libro.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
                        <div class="input-group">
                            {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Search a Book...','aria-describedby'=>'search'])!!}
                            <span class="input-group-addon" id="search"><button style="border:none;">Search</button></span>
                        </div>
                    {!!Form::close()!!}
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Pages</th>
                            <th>Price</th>
                            <th>Editorial</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>{{$book->pages}}</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->editorial}}</td>
                            <td>{{$book->autor->name}}</td>
                            <td>
                            @if($role==2||$role==1)
                                {!!Form::model($book,array('route'=>['libro.destroy',$book->id],'method'=>'DELETE'))!!}
                                    {{link_to_route('libro.edit','Update',[$book->id],['class'=>'btn btn-primary'])}}

                                    {!!Form::button('Delete',['class'=>'btn btn-danger','type'=>'submit'])!!}                                  
                                {!!Form::close()!!}
                            @endif

                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @if($role==2||$role==1)
            {{link_to_route('libro.create','Add New Book',null,['class'=>'btn btn-primary']) }}
            @endif
            <a class="btn btn-danger" href="{{ url('/') }}">Back</a>
        </div>
    </div>
</div>
@endsection
