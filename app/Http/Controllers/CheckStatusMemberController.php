<?php

namespace App\Http\Controllers;

use App\Models\CheckTrainerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckStatusMemberController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login

        $userId = Auth::id();

        // Query untuk mengambil data dari tabel yang sesuai dengan pengguna yang login
        $checkstatuss = DB::table(DB::raw('(SELECT 0 as typeCs, cs.id, cs.registration_id, m.name, cs.created_at, "" AS trainer_name FROM check_statuses AS cs 
        INNER JOIN registrations AS r ON r.id=cs.registration_id
        INNER JOIN users AS m ON m.id=r.member_id
        where cs.deleted_at is null AND r.member_id = '.$userId.'
        UNION
        SELECT 1 as typeCs, cs.id, cs.registration_id, m.name, cs.created_at, t.name AS trainer_name FROM check_trainer_statuses AS cs 
        INNER JOIN registrations AS r ON r.id=cs.registration_id
        INNER JOIN users AS m ON m.id=r.member_id
        INNER JOIN trainers AS t ON t.id=r.trainer_id where cs.deleted_at is null AND r.member_id = '.$userId.') AS main_data'))
        ->orderBy('created_at')
        ->get();

        $data = [
            'title' => 'check',
            'checkstatuss' => $checkstatuss,
        ];

        return view('check-status-member.index', $data);
    }
}

