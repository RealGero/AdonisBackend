<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'company_id';

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('User','user_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review','company_id');
    }
}

