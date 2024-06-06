<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Trainer;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\MemberPackage;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::with('memberPackage', 'trainer', 'user')->get();
        $registrations->each(function ($registration) {
            $user = User::find($registration->member_id);
            $registration->member_name = $user ? $user->name : "Nama Pengguna Tidak Tersedia";
        });
        $data = [
            'title' => 'Member Registrations Data',
            'registrations' => $registrations,
        ];

        return view('registration-admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Member Registration Data',
            'memberPackages' => MemberPackage::get(),
            'trainers' => Trainer::get(),
            'users' => User::get(),
        ];

        return view('registration-admin.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_package_id' => 'required|exists:member_packages,id',
            'member_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
            'trainer_id' => 'nullable|exists:trainers,id',
        ]);
        $user = User::find($request->member_id);

        $memberPackage = MemberPackage::find($request->member_package_id);
        $data = [
            'user_id' => Auth::id(),
            'member_id' => $request->member_id,
            'member_package_id' => $request->member_package_id,
            'price' => $request->price,
            'start_date' => now(),
        ];

        if ($memberPackage->is_with_trainer) {
            $data['trainer_id'] = $request->trainer_id;
        }

        Registration::create($data);

        return redirect()->route('registration-admin.index')->with('success', 'Registrasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
