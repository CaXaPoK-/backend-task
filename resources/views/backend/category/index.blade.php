@extends('app')
@include('header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories
                        <a href="{{\URL::action('Backend\CategoryController@getCreate')}}" class="btn btn-default pull-right">
                            Add</a>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th width="45px">ID</th>
                            <th>Caption</th>
                            <th width="135px">Status</th>
                            <th width="135px">Actions</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>
                                    <a href="{{$category->url}}" target="_blank">{{$category->caption}}</a>
                                </td>
                                <td>{{($category->active) ? 'Active' : 'Hidden'}}</td>
                                <td>
                                    <a href="{{\URL::action('Backend\CategoryController@getEdit', ['id' => $category->id])}}" class="btn btn-default">
                                        Edit</a>
                                    <a href="{{\URL::action('Backend\CategoryController@getDestroy', ['id' => $category->id])}}" class="btn btn-default">
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
