<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'registration_id',
    ];    
    protected $dates = ['deleted_at'];
    public function registration(){
        return $this->belongsTo(Registration::class);
    }
}
