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
use App\Slug;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $page = 'category';

        \View::share('page', $page);
    }

    public function getIndex()
    {
        $categories = Category::query()
            ->get();

        return \View::make(
            'backend.category.index',
            [
                'categories' => $categories
            ]
        );
    }

    public function getCreate()
    {
        return \View::make('backend.category.create');
    }

    public function postCreate(Request $request)
    {
        $this->validate(
            $request,
            [
                'caption' => 'required'
            ]
        );

        $category = new Category();
        $data = $request->only(['caption', 'slug', 'active']);

        $data['slug'] = (empty($data['slug'])) ? Slug::make($data['caption']) : Slug::make($data['slug']);
        $slug = Category::withTrashed()
            ->where('slug', 'like', $data['slug'])
            ->first(['id']);

        if ($slug) {
            return redirect(\URL::action('Backend\CategoryController@getCreate'))
                ->withInput($data)
                ->withErrors(
                    [
                        'URL already exists.',
                    ]
                );
        }

        $category->fill($data);
        $category->save();

        return redirect(\URL::action('Backend\CategoryController@getIndex'));
    }

    public function getEdit($id)
    {
        $category = Category::query()
            ->findOrFail($id);

        return \View::make(
            'backend.category.edit',
            [
                'category' => $category
            ]
        );
    }

    public function postEdit($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'caption' => 'required'
            ]
        );

        $category = Category::query()
            ->findOrFail($id);
        $data = $request->only(['caption', 'slug', 'active']);

        $data['slug'] = (empty($data['slug'])) ? Slug::make($data['caption']) : Slug::make($data['slug']);
        $slug = Category::withTrashed()
            ->where('slug', 'like', $data['slug'])
            ->first(['id']);

        if ($slug && $slug->id != $id) {
            return redirect(\URL::action('Backend\CategoryController@getCreate'))
                ->withInput($data)
                ->withErrors(
                    [
                        'URL already exists.',
                    ]
                );
        }

        $category->fill($data);
        $category->save();

        return redirect(\URL::action('Backend\CategoryController@getIndex'));
    }

    public function getDestroy($id)
    {
        Category::query()
            ->findOrFail($id)
            ->delete();

        return redirect(\URL::action('Backend\CategoryController@getIndex'));
    }
}