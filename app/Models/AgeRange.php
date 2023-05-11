<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model
{
    use HasFactory;

    protected $table = 'age_range';

    protected $fillable = [
        'age_range'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'age', 'id');
    }
}
