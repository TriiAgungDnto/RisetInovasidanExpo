<?php

namespace App\Models;

use App\Models\Major;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Innovation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
