<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        return view('Template.index');
    }

    public function elements()
	{
	    return view('Template.elements');
	}

    public function generic()
    {
        return view('Template.generic');
    }

}
