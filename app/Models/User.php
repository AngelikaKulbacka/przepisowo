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

    public function getPrintableName(): string {
        return "{$this->imie} {$this->nazwisko}";
    }

    public function recepies() {
        return $this->hasMany(Recipe::class, 'id_uzytkownika');
    }

    public function photo() {
        return $this->belongsTo(Photo::class, 'id_zdjecia');
    }

    public function public() {
        return $this->recepies()->where('czy_prywatne', false);
    }

    public function private() {
        return $this->recepies()->where('czy_prywatne', true);
    }
}
