<?php

namespace App\Http\Controllers;

use App\Models\CheckTrainerStatus;
use Illuminate\Http\Request;

class CheckStatusMemberController extends Controller
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

        return view('check-status-member.index', $data);
    }
}
