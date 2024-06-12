<?php

namespace App\Http\Controllers;

use App\Models\CheckTrainerStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckStatusController extends Controller
{
    public function index ()
    {

        $checkstatuss = CheckTrainerStatus::all();
        $total= CheckTrainerStatus::where('registration_id')->count();
        $data = [
            'title' => 'check',
            'checkstatuss' => $checkstatuss,
            'total' => $total,
        ];

        return view('check-status.index', $data);
    }


}