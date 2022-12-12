<?php

namespace App\Http\Controllers;

use Cornford\Googlmapper\Mapper;
use Cornford\Googlmapper\Models\Map;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class MapController extends Controller
{
    public function index()
    {
        return view('map.map');
    }
}
