<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'user_gallery';

    public function owner() {
        return $this->belongsTo('App\Models\User', 'user_gallery');
    }
}
