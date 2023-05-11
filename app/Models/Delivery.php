<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'delivery';

    protected $fillable = [
        'delivery_from'
    ];

    public function product()
    {
        $this->hasMany(Product::class, 'delivery', 'id');
    }
}
