@extends('app')
@include('header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles
                        <a href="{{\URL::action('Backend\ArticleController@getCreate')}}" class="btn btn-default pull-right">
                            Add</a>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th width="45px">ID</th>
                            <th>Caption</th>
                            <th width="135px">Date</th>
                            <th width="135px">Status</th>
                            <th width="135px">Actions</th>
                        </tr>
                        @foreach($articles as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <a href="{{$item->url}}" target="_blank">{{$item->caption}}</a>
                                </td>
                                <td>{{$item->publish_at->format('d.m.Y')}}</td>
                                <td>{{($item->active) ? 'Active' : 'Hidden'}}</td>
                                <td>
                                    <a href="{{\URL::action('Backend\ArticleController@getEdit', ['id' => $item->id])}}" class="btn btn-default">
                                        Edit</a>
                                    <a href="{{\URL::action('Backend\ArticleController@getDestroy', ['id' => $item->id])}}" class="btn btn-default">
                                        Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
