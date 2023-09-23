<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MagicController extends Controller
{
    public function showMagicForm()
    {
		return view('email.magic-link');
    }

    public function sendToken(Request $request)
    {

    }
}
