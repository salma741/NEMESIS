<?php
namespace App\Http\Controllers;

use App\Models\CheckStatus;
use App\Models\CheckTrainerStatus;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\MemberPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $registrations = DB::table('registrations')
    ->leftJoin('users as admin', 'admin.id', '=', 'registrations.user_id')
    ->join('users as member', 'member.id', '=', 'registrations.member_id')
    ->join('member_packages', 'member_packages.id', '=', 'registrations.member_package_id')
    ->leftJoin('trainers', 'trainers.id', '=', 'registrations.trainer_id')
    ->leftJoin(DB::raw('(SELECT count(id) as total_check_in_trainer, registration_id FROM `check_trainer_statuses` GROUP BY registration_id) as check_status_count'), 'check_status_count.registration_id', '=', 'registrations.id')
    ->select([
        'registrations.start_date',
        DB::raw('DATE_ADD(registrations.start_date, INTERVAL member_packages.duration_day DAY) as end_date'),
        DB::raw('DATEDIFF(NOW(), DATE_ADD(registrations.start_date, INTERVAL member_packages.duration_day DAY)) as can_check_in'),
        
        'member.name as member_name',
        'admin.name as admin_name',
        'member_packages.duration_day',
        'member_packages.duration_trainer',
        'check_status_count.total_check_in_trainer',
        'member_packages.name as member_package_name', 
        'trainers.name as trainer_name',
        'registrations.price',
        'registrations.id'
    ])
    ->get();
        // dd($registrations);
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
            'users' => User::where('role', 'member')->get(),
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
        $registration = Registration::find($id);
    if (!$registration) {
        return redirect('registration-admin')->with("errorMessage", 'Registrasi tidak ditemukan');
    }
    // $registration->start_date_formatted = Carbon::parse($registration->start_date)->format('d-m-Y H:i:s');
    // $registration->end_date_formatted = Carbon::parse($registration->start_date)->addDays($registration->memberPackage->duration_day)->format('d-m-Y H:i:s');

    $data = [
        'title' => 'Registration Detail',
        'registration' => $registration,
        'memberPackages' => MemberPackage::all(),
        'trainers' => Trainer::all(),
        'users' => User::all(),
    ];

    return view('registration-admin.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $registration = Registration::find($id);
    if (!$registration) {
        return redirect('registration-admin')->with("errorMessage", 'Registration not found');
    }

    $data = [
        'title' => 'Edit Registration',
        'registration' => $registration,
        'memberPackages' => MemberPackage::all(),
        'trainers' => Trainer::all(),
        'users' => User::all(),
    ];

    return view('registration-admin.form', $data);
}
   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi data yang diterima
    $request->validate([
        'member_id' => 'required|exists:users,id',
        'member_package_id' => 'required|exists:member_packages,id',
        'price' => 'required|numeric',
        'trainer_id' => 'nullable|exists:trainers,id',
    ]);

    // Temukan registrasi yang ada
    $registration = Registration::find($id);
    if (!$registration) {
        return redirect('registration-admin')->with("errorMessage", 'Registrasi tidak ditemukan');
    }

    // Temukan user dan paket member
    $user = User::find($request->member_id);
    $memberPackage = MemberPackage::find($request->member_package_id);

    $data = [
        'user_id' => Auth::id(),
        'member_id' => $request->member_id,
        'member_package_id' => $request->member_package_id,
        'price' => $request->price,
    ];

    if ($memberPackage->is_with_trainer) {
        $data['trainer_id'] = $request->trainer_id;
    }
    $registration->update($data);

    return redirect()->route('registration-admin.index')->with('success', 'Registrasi berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    try {
        $registration = DB::table('registrations')
            ->where('registrations.id', $id)
            ->leftJoin('users as admin', 'admin.id', '=', 'registrations.user_id')
            ->join('users as member', 'member.id', '=', 'registrations.member_id')
            ->join('member_packages', 'member_packages.id', '=', 'registrations.member_package_id')
            ->leftJoin('trainers', 'trainers.id', '=', 'registrations.trainer_id')
            ->leftJoin(DB::raw('(SELECT count(id) as total_check_in_trainer, registration_id FROM `check_trainer_statuses` GROUP BY registration_id) as check_status_count'), 'check_status_count.registration_id', '=', 'registrations.id')
            ->select([
                'registrations.start_date',
                DB::raw('DATE_ADD(registrations.start_date, INTERVAL member_packages.duration_day DAY) as end_date'),
                DB::raw('DATEDIFF(NOW(), DATE_ADD(registrations.start_date, INTERVAL member_packages.duration_day DAY)) as can_check_in'),
                
                'member.name as member_name',
                'admin.name as admin_name',
                'member_packages.duration_day',
                'member_packages.duration_trainer',
                'check_status_count.total_check_in_trainer',
                'member_packages.name as member_package_name', 
                'trainers.name as trainer_name',
                'registrations.price',
                'registrations.id'
            ])
            ->first();
        
        if (!$registration) {
            return redirect('registration-admin')->with("errorMessage", "Registrasi tidak ditemukan!");
        }
        DB::table('registrations')->where('id', $id)->delete();

        return redirect('registration-admin')->with("successMessage", "Data berhasil dihapus!");
    } catch (\Throwable $e) {
        return redirect('registration-admin')->with("errorMessage", "Terjadi kesalahan saat menghapus data!");
    }
}
    public function checkIn(Request $request)
    {
        $data = $request->validate([
            'registration_id' => 'required'
        ]);

        CheckStatus::create($data);

        return redirect()->route('registration-admin.index')->with('success', 'Check in berhasil dibuat.');
    }

    public function trainerCheckIn(Request $request)
    {
        $data = $request->validate([
            'registration_id' => 'required'
        ]);

        CheckTrainerStatus::create($data);

        return redirect()->route('registration-admin.index')->with('success', 'Check in trainer berhasil dibuat.');
    }    
}

?>
