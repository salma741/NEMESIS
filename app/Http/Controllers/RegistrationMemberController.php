<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Trainer;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\MemberPackage;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input("startDate");
        $endDate = $request->input("endDate");

        $now = Carbon::now();
        $startDate = $startDate ?: null;
        $endDate = $endDate ?: null;

        $user = auth()->user();
        $registrations = Registration::with('memberPackage', 'trainer', 'user')
        ->where('member_id', $user->id)
        ->where(function ($query) use ($startDate, $endDate) {
            if ($startDate !== null && $endDate !== null) {
                $query->whereBetween('start_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
            }

        })
        ->orderby('start_date', 'desc')
        ->get();
        $configurations = Configuration::all();
        $hasRegistrations = $registrations->isNotEmpty();

        $data = [
            'title' => 'Member Registration Data',
            'information' => 'Berikut adalah data registrasi member anda.',
            'registrations' => $registrations,
            'configurations' => $configurations,
            'hasRegistrations' => $hasRegistrations,
            "startDate" => $startDate,
            "endDate" => $endDate,
        ];

        return view('registration-member.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = [
            'title' => 'Add Member Registration Data',
            'information' => 'Silahkan registrasi paket anda',
            'memberPackages' => MemberPackage::get(),
            'trainers' => Trainer::get(),
            'configurations' => app('configurations'),
        ];

        return view('registration-member.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
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
            'status' => 'unpaid',
        ];

        if ($memberPackage->is_with_trainer) {
            $data['trainer_id'] = $request->trainer_id;
        }

        $registration = Registration::create($data);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $registration->id,
                'gross_amount' => $registration->price,
            ),
            'customer_details' => array(
                'user_id' => $registration->user_id,
                'name' => $registration->name,
                'member_id' => $registration->member_id,
                'member_package_id' => $registration->member_package_id,
            ),
        );
        $name = Auth()->user()->name;
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('registration-member.checkout', ['title' => "Pay member registration"], compact('snapToken', 'registration', 'memberPackage'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $registration = Registration::find($request->order_id);
                $registration->update(['status' => 'paid']);
            }
        }
    }

    public function show(string $id)
    {
        $registration = Registration::find($id);
    if (!$registration) {
        return redirect('registration-member')->with("errorMessage", 'Registrasi tidak ditemukan');
    }
    // $registration->start_date_formatted = Carbon::parse($registration->start_date)->format('d-m-Y H:i:s');
    // $registration->end_date_formatted = Carbon::parse($registration->start_date)->addDays($registration->memberPackage->duration_day)->format('d-m-Y H:i:s');

    $data = [
        'title' => 'Bill Detail',
        'registration' => $registration,
        'memberPackages' => MemberPackage::all(),
        'trainers' => Trainer::all(),
        'users' => User::all(),
        'status' => $registration->status,
    ];

    return view('registration-member.bill', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
}
