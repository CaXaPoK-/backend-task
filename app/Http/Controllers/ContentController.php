<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 10:08 PM
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Routing\Route;

class ContentController extends Controller
{
    public function __construct ()
    {
        $categories = Category::query()
            ->where('active', '=', '1')
            ->get();

        \View::share('categories', $categories);
    }

    public function index()
    {
        $articles = Content::query()
            ->where('active', '=', '1')
            ->orderBy('publish_at', 'desc')
            ->limit(3)
            ->get();

        return \View::make(
            'frontend.index',
            [
                'articles' => $articles
            ]
        );
    }

    public function category(Route $route)
    {
        $category = Category::query()
            ->where('slug', '=', $route->parameter('category'))
            ->firstOrFail();

        $articles = Content::query()
            ->where('category_id', '=', $category->id)
            ->where('active', '=', '1')
            ->orderBy('publish_at', 'desc')
            ->paginate(1);

        return \View::make(
            'frontend.category',
            [
                'category' => $category,
                'articles' => $articles
            ]
        );
    }

    public function article(Route $route)
    {
        $article = Content::query()
            ->with('category')
            ->findOrFail($route->parameter('id'));

        return \View::make(
            'frontend.article',
            [
                'article' => $article
            ]
        );
    }

}