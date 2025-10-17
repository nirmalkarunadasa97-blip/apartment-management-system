<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentImage extends Model
{
    use HasFactory;

    protected $table = 'apartment_images';
    protected $primaryKey = 'apartment_image_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'apartment_id',
        'image_url',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id', 'apartment_id');
    }
}
