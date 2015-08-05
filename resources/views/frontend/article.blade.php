@extends('app')
@include('frontend.header')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url($article->category->url) }}">{{ $article->category->caption }}</a></li>
                        <li class="active">{{ $article->caption }}</li>
                    </ol>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>{{ $article->caption }}</h3>
                                        <p>{{ $article->description }}</p>
                                        <p>{{ $article->text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
