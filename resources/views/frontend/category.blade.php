@extends('app')
@include('frontend.header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">{{ $category->caption }}</div>
                    <div class="panel-body">
                        @foreach($articles as $item)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>{{ $item->caption }}</h3>
                                            <p>{{ $item->description }}</p>
                                            <p>
                                                <a href="{{ url($item->url) }}" class="btn btn-primary pull-right">Read</a>
                                            <div class="clearfix"></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!! $articles->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
