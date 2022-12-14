<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Photo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_name');
    }
    
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

}