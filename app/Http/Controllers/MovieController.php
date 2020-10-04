<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index($request){

        return $request->json("Success Request");
    }
}
