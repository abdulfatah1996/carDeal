<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'lname',
        'phone',
        'address',
        'national_id',
        'gender',
        'dob',
        'img_path',
        'user_id',
    ];
}
