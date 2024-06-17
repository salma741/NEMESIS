<?php

namespace App\Http\Controllers;

use App\Models\CheckTrainerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckStatusMemberController extends Controller
{public function index()
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::id();

        // Fetch the status records for the logged-in user only
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
