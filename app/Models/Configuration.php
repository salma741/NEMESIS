<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $fillable = [
        'name',
        'address',
        'phone',
        'map_link',
        'motivation_1',
        'motivation_2' ,
        'paragraph_program',
        'paragraph_trainer',
        'paragraph_supplement',
    ];
}
