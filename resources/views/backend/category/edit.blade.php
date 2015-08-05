@extends('app')
@include('header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories
                        <a href="{{\URL::action('Backend\CategoryController@getIndex')}}"
                           class="btn btn-default pull-right">Back</a>

                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" action="{{\URL::action('Backend\CategoryController@postEdit', ['id' => $category->id])}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Caption</label>
                                            <input type="text" class="form-control" name="caption"
                                                   value="{{old('caption', $category->caption)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">URL</label>
                                            <input type="text" class="form-control" name="slug"
                                                   value="{{old('slug', $category->slug)}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select name="active" class="form-control">
                                                <option {{($category->active == 1) ? 'selected' : ''}} value="1">
                                                    Active
                                                </option>
                                                <option {{($category->active == 0) ? 'selected' : ''}} value="0">
                                                    Hidden
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-default">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
