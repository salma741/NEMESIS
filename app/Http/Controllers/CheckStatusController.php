<?php

namespace App\Http\Controllers;

use App\Models\CheckStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckStatusController extends Controller
{
    public function index ()
    {

        $checkstatuss = CheckStatus::all();
       
        $data = [
            'title' => 'check',
            'checkstatuss' => $checkstatuss,
        ];

        return view('check-status.index', $data);
    }


}