<?php

namespace App\Http\Controllers;

use App\Models\CheckStatus;
use App\Models\CheckTrainerStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class CheckStatusController extends Controller
{
    public function index ()
    {

        // $checkstatuss = CheckTrainerStatus::get();
        $checkstatuss = DB::table(DB::raw('(SELECT 0 as typeCs, cs.id, cs.registration_id, m.name, cs.created_at, "" AS trainer_name FROM check_statuses AS cs 
        INNER JOIN registrations AS r ON r.id=cs.registration_id
        INNER JOIN users AS m ON m.id=r.member_id
        where cs.deleted_at is null
        UNION
        SELECT 1 as typeCs, cs.id, cs.registration_id, m.name, cs.created_at, t.name AS trainer_name FROM check_trainer_statuses AS cs 
        INNER JOIN registrations AS r ON r.id=cs.registration_id
        INNER JOIN users AS m ON m.id=r.member_id
        INNER JOIN trainers AS t ON t.id=r.trainer_id where cs.deleted_at is null) AS main_data'))
        ->orderBy('created_at')
        ->get();
    
        
        // $total= CheckTrainerStatus::where('registration_id')->count();
        $data = [
            'title' => 'check',
            'checkstatuss' => $checkstatuss,

        ];

        return view('check-status.index', $data);
    }

    public function destroyCs(string $id)
    {
        try {
            $checkStatus = CheckStatus::findOrFail($id);
            $checkStatus->delete(); // menggunakan soft delete

            return redirect("check-status")->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect("check-status")->with("errorMessage", "Data gagal dihapus!");
        }
    }

    public function destroyCst(string $id)
    {
        
            try {
                $checkStatus = CheckTrainerStatus::findOrFail($id);
                $checkStatus->delete(); // menggunakan soft delete
    
                return redirect("check-status")->with("successMessage", "Data berhasil dihapus!");
            } catch (\Throwable $th) {
                dd($th->getMessage());
                return redirect("check-status")->with("errorMessage", "Data gagal dihapus!");
            }
    }


}