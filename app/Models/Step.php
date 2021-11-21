<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'opis',
        'nr_kroku',
        'id_przepisu',
    ];

    protected $table = 'kroki';
}

