<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected function valid(array $data)
    {
        return validator($data, [
            'name' => 'required|max:2',
            'email' => ['required', 'email',],
            'password' => 'required|min:20',
        ])->validate();
    }


    public function index()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        dd($this->valid($request->all()));
    }
    //
}
