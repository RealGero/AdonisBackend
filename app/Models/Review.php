<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{   
    
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'review_id';

    protected $guarded = [];

    public function company(){

        return $this->belongsTo('App\Models\Company','company_id','review_id');
    }

    public function guest(){

        return $this->belongsTo('App\Models\Guest','guest_id','review_id');
    }

    public function totals()
    {
        return $this->hasMany('App\Models\Total');
    }
}
