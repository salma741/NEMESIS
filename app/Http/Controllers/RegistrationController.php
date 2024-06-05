<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use App\Models\User;

use Illuminate\Http\Request;

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
            'title' => 'Data Registrations',
            'registrations' => $registrations,
        ];

        return view('registration-admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
