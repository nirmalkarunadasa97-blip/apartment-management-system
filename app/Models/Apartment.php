<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $primaryKey = 'apartment_id';

    protected $fillable = [
        'apartment_no',
        'description',
        'contact_no',
        'no_of_bathroom',
        'no_of_bedroom',
        'monthly_rent',
        'status',
        'user_id',
    ];

    protected $casts = [
        'monthly_rent' => 'decimal:2',
        'status' => 'integer',
        'no_of_bathroom' => 'integer',
        'no_of_bedroom' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ApartmentImage::class, 'apartment_id', 'apartment_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'apartment_id', 'apartment_id');
    }
}
