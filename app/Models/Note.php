<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'notes';
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
        // return $this->belongsTo(User::class, 'user_id'); Using a 'foreign key' if needed cos of error
    }

}
