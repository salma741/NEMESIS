<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Registration;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\MemberPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::with('memberPackage', 'trainer', 'user')->where('member_id', auth()->user()->id)->get();
        $configurations = Configuration::all();
        $data = [
            'title' => 'Member Registration Data',
            'information' => 'Berikut adalah daqwta registrasi member anda.',
            'registrations' => $registrations,
            'configurations' => $configurations,
        ];

        return view('registration-member.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $configurations = Configuration::all();
        $data = [
            'title' => 'Add Member Registration Data',
            'information' => 'Silahkan registrasi paket anda',
            'memberPackages' => MemberPackage::get(),
            'trainers' => Trainer::get(),
            'configurations' => $configurations,
        ];

        return view('registration-member.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //TODO: lanjutkan utk store, note: jika paket yg dipilih adl paket tanpa trainer, maka unset(trainer_id) selain itu lanjutkan

        $request->validate([
            'member_package_id' => 'required|exists:member_packages,id',
            'price' => 'required|numeric',
            'trainer_id' => 'nullable|exists:trainers,id',
        ]);

        $memberPackage = MemberPackage::find($request->member_package_id);
        $data = [
            'user_id' => null,
            'member_id' => Auth::id(),
            'member_package_id' => $request->member_package_id,
            'price' => $request->price,
            'start_date' => now(),
        ];

        if ($memberPackage->is_with_trainer) {
            $data['trainer_id'] = $request->trainer_id;
        }

        Registration::create($data);

        return redirect()->route('registration-member.index')->with('success', 'Registrasi berhasil dibuat.');
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
