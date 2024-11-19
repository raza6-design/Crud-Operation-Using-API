<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class user extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    // public $timestamps = false;
    protected $fillable = ['name','email','password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
