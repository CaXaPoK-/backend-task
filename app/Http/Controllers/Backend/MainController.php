<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 7:43 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function __construct()
    {
        $page = 'index';

        \View::share('page', $page);
    }

    public function getIndex()
    {
        return \View::make('backend.index');
    }
}