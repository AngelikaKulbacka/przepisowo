<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'zdjecia';
    protected $fillable = [
        'nazwa', 'nazwa_uzytkownika'
    ];

    public function getUrl() {
        return url('storage/photo/'. $this->nazwa);
    }

    public static function getDefaultUserPhoto() {
        return url('storage/photo/DefaultUserPhoto.png');
    }

    public static function getDefaultRecipePhoto() {
        return url('storage/photo/DefaultRecipePhoto.png');
    }


    public static function createPhoto(UploadedFile $file): Photo {
        $file->store('public/photo');
        $photo = new Photo();
        $photo->nazwa = $file->hashName();
        $photo->nazwa_uzytkownika = $file->getClientOriginalName();
        $photo->save();

        return $photo;
    }

}
