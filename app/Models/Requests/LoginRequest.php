<?php

namespace App\Models\Requests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
    ];
}
