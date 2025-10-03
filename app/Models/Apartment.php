<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $primaryKey = 'apartment_id';

    protected $fillable = [
        'contact_no',
        'no_of_bedroom',
        'no_of_bathroom',
        'apartment_no',
        'monthly_rent',
        'description',
        'status',
    ];

    public function images()
    {
        return $this->hasMany(ApartmentImage::class);
    }
}
