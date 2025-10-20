<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentApplication extends Model
{
    use HasFactory;
    use HasFactory;

    protected $primaryKey = 'apartment_application_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }
}
