<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'order_info',
        'id_user',
        'status_order',
        'price_order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function statusOrder()
    {
        return $this->belongsTo(StatusOrder::class, 'status_order', 'id');
    }
}
