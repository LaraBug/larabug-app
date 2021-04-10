<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_id',
        'description',
        'end_date',
        'amount',
        'payer_id',
        'success',
        'period'
    ];

    protected $dates = [
        'end_date'
    ];

    protected $casts = [
        'success' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function scopePaid()
    {
        return $this->whereSuccess(true);
    }

    public function isPaid()
    {
        return $this->success;
    }
}
