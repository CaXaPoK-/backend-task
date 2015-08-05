@extends('app')
@include('header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles
                        <a href="{{\URL::action('Backend\ArticleController@getIndex')}}"
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
                        <form role="form"
                              action="{{\URL::action('Backend\ArticleController@postEdit', ['id' => $article->id])}}"
                              method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select name="category_id" class="form-control">
                                                @foreach($categories as $category)
                                                    <option {{($article->category_id == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->caption}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select name="active" class="form-control">
                                                <option {{($article->active == 1) ? 'selected' : ''}} value="1">Active
                                                </option>
                                                <option {{($article->active == 0) ? 'selected' : ''}} value="0">Hidden
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date (Datepicker here)</label>
                                            <input type="text" class="form-control" readonly="" name="publish_at"
                                                   value="{{old('publish_at', $article->publish_at->format('d.m.Y'))}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Caption</label>
                                            <input type="text" class="form-control" name="caption"
                                                   value="{{old('caption', $article->caption)}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" name="description"
                                                      rows="3">{{old('description', $article->description)}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Text (WYSIWYG editor here)</label>
                                            <textarea class="form-control" name="text"
                                                      rows="5">{{old('text', $article->text)}}</textarea>
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
