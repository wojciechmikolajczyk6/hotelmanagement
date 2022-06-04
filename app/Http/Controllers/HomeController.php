<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Roomimage;

class HomeController extends Controller
{
    // Home Page
    public function index()
    {
        $services=Service::all();
        $roomTypes=RoomType::all();
        return view('/index', ['roomtypes'=>$roomTypes, 'services' =>   $services]);
    }

    public function servicePage($id){
        $service=Service::find($id);
        return view('serviceShow', ['service'=>$service]);
    }
    public function galery(){
        $roomTypes=RoomType::all();
        return view('galery', ['roomtypes'=>$roomTypes]);
    }
    public function services(){
        $services=Service::all();
        return view('services', ['services' =>$services]);
    }
}
