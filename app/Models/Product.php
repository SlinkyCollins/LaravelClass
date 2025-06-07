<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'image'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
