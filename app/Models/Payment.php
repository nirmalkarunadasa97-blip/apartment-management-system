<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'amount',
        'currency',
        'status',
        'apartment_id',
        'resident_id',
        'apartment_application_id',
        'payment_type_id',
        'payment_year',
        'payment_month'
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    public function payment_type()
    {
        return $this->belongsTo(paymentType::class, 'payment_type_id');
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }
}
