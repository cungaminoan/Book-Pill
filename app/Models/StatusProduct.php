<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusProduct extends Model
{
    use HasFactory;

    protected $table = 'status_product';

    protected $fillable = [
        'status_product'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'status_product', 'id');
    }
}
