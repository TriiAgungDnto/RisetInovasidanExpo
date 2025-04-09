<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user_author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
