<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'payment_method_id',
        'company_id',
        'vat_rate',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
