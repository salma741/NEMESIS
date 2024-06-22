<?php

namespace App\Http\Controllers;

use App\Models\MemberPackage;
use App\Models\Registration;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminHome()
{
    // Menghitung jumlah paket anggota secara otomatis
    $memberPackageCount = MemberPackage::count();
    $userCount = User::count();
    $trainerCount = Trainer::count();
    $registrationCount = Registration::count();

    // Query untuk mengambil data registrasi per paket member
    $registrationsPerPackage = DB::table('registrations')
        ->join('member_packages', 'registrations.member_package_id', '=', 'member_packages.id')
        ->select('member_packages.name as package_name', DB::raw('COUNT(registrations.id) as count'))
        ->groupBy('member_packages.name')
        ->get();

    $data = [
        "title" => "Dashboard",
        "memberPackageCount" => $memberPackageCount,
        "userCount" => $userCount,
        "trainerCount" => $trainerCount,
        "registrationCount" => $registrationCount,
        "registrationsPerPackage" => $registrationsPerPackage, // Data untuk grafik

    ];
    
    return view('dashboard', $data);
}

}
