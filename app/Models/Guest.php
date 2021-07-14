<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guests';
    protected $primaryKey = 'guest_id';

    protected $guarded = [];

    public  function user()
    {
        return $this->belongsTo(User::class);
    }
}
