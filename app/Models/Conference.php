<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
