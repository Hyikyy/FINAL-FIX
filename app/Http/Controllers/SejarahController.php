<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function showPublic()
    {

        return view('sejarah.index');
    }
}
