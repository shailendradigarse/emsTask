<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    public function eventPayments()
    {
        return $this->hasMany(EventPayment::class);
    }

    public function paymentProviderRequests()
    {
        return $this->hasMany(PaymentProviderRequest::class);
    }
}
