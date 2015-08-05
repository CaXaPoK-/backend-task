<?php
/**
 * Created by PhpStorm.
 * User: caxapok
 * Date: 8/5/15
 * Time: 7:08 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getIndex()
    {
        return \View::make('backend.auth.login');
    }

    public function postIndex(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'    => 'required',
                'password' => 'required'
            ]
        );

        $credentials = $request->only('email', 'password');
        if (\Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('/backend');
        }

        return redirect('/backend/auth')
            ->withInput($request->only('email'))
            ->withErrors(
                [
                    'email' => 'These credentials do not match our records.',
                ]
            );
    }

    public function getLogout()
    {
        \Auth::logout();

        return redirect(url('/'));
    }
}