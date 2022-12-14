<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;
use App\Models\User;

class Photo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'image',
    ];

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Photo');
    }

}
