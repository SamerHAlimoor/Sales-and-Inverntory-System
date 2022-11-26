<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "admins";
    protected $fillable = [
        'name', 'email', 'username', 'password', 'created_at', 'updated_at', 'added_by', 'updated_by', 'com_code'
    ];
}