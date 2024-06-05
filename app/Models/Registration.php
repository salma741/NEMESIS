<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function member(){
        return $this->belongsTo(User::class, 'member_id');
    }

    public function memberPackage(){
        return $this->belongsTo(MemberPackage::class);
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
}
