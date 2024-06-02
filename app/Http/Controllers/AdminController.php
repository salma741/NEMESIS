<?php

namespace App\Http\Controllers;

use App\Models\MemberPackage;
use App\Models\Registration;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminHome() {
        // Menghitung jumlah paket anggota secara otomatis
        $memberPackageCount = MemberPackage::count();
        $userCount = User::count();
        $trainerCount = Trainer::count();
        $registrationCount = Registration::count();
        $data = [
            "title" => "Dashboard",
            "memberPackageCount" => $memberPackageCount,
            "userCount" => $userCount,
            "trainerCount" => $trainerCount,
            "registrationCount" => $registrationCount,

        ];
            return view('dashboard', $data);
        }
}
