@extends('layouts.app')

@section('content')
<style>
            .full-height {
                height: 60vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                letter-spacing: .1rem;
                text-decoration: none;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md links">
            <a href="api/v1/author">Authors</a>
            <a href="api/v1/book">Books</a>
            <a href="api/v1/editorial">Editorials</a>
        </div>
    </div>

</div>
@endsection
