<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Configuration;
use App\Models\MemberPackage;
use App\Models\Program;
use App\Models\Supplement;
use App\Models\Trainer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $data = [
            "programs" => Program::get(),
            "supplements" => Supplement::limit(4)->get(),
            "trainers" => Trainer::get(),
            "carousels" => Carousel::get(),
            "memberPackages" => MemberPackage::get(),
            "configurations" => Configuration::get(),
        ];
        
        return view('home',  $data);
    }
}
