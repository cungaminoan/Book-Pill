<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $fillable = [
        'author_name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'author', 'id');
    }
}
