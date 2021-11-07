<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'uzytkownicy';
    protected $fillable = [
        'login',
        'haslo',
        'email',
        'imie',
        'nazwisko',
    ];

    public function getAuthPassword()
    {
        return $this->haslo;
    }
}
