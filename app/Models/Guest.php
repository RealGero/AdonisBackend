<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Guest extends Model
{   
    use SoftDeletes;
    use HasFactory;

    protected $table = 'guests';
    protected $primaryKey = 'guest_id';

    protected $guarded = [];

    public  function user()
    {
        return $this->belongsTo('App\Models\User','user_id','guest_id');
    }
}
