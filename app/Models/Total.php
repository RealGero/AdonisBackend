<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{   
    
    use HasFactory;

    protected $table = 'totals';
    protected $primaryKey = 'total_id';

    protected $guarded = [];


    public function reviews()
    {
        return $this->belongsTo('App\Models\Review','review_id','total_id');
    }
}
