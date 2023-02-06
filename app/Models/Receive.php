<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Models\Member;

class Receive extends Model
{
    use HasFactory, SoftDeletes;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
}
