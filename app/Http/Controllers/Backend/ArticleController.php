<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 7:52 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $page = 'article';

        \View::share('page', $page);
    }

    public function getIndex()
    {
        $articles = Content::query()
            ->orderBy('publish_at', 'desc')
            ->get();

        return \View::make(
            'backend.article.index',
            [
                'articles' => $articles
            ]
        );
    }

    public function getCreate()
    {
        $categories = Category::query()
            ->get();

        return \View::make(
            'backend.article.create',
            [
                'categories' => $categories
            ]
        );
    }

    public function postCreate(Request $request)
    {
        $this->validate(
            $request,
            [
                'caption'     => 'required',
                'description' => 'required',
                'text'        => 'required'
            ]
        );

        $content = new Content();
        $data = $request->only(['category_id', 'active', 'publish_at', 'caption', 'description', 'text']);
        $data['publish_at'] = Carbon::createFromFormat('d.m.Y', $data['publish_at']);

        $content->fill($data);
        $content->save();

        return redirect(\URL::action('Backend\ArticleController@getIndex'));
    }

    public function getEdit($id)
    {
        $article = Content::query()
            ->findOrFail($id);

        $categories = Category::query()
            ->get();

        return \View::make(
            'backend.article.edit',
            [
                'categories' => $categories,
                'article'    => $article
            ]
        );
    }

    public function postEdit($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'caption'     => 'required',
                'description' => 'required',
                'text'        => 'required'
            ]
        );

        $content = Content::query()
            ->findOrFail($id);
        $data = $request->only(['category_id', 'active', 'publish_at', 'caption', 'description', 'text']);
        $data['publish_at'] = Carbon::createFromFormat('d.m.Y', $data['publish_at']);

        $content->fill($data);
        $content->save();

        return redirect(\URL::action('Backend\ArticleController@getIndex'));
    }

    public function getDestroy($id)
    {
        Content::query()
            ->findOrFail($id)
            ->delete();

        return redirect(\URL::action('Backend\ArticleController@getIndex'));
    }
}