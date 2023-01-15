<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Models\Member;

class Receive extends Model
{
    use HasFactory, SoftDeletes;

    public function get_member()
    {
        return $this->belongsTo(Member::class);
    }
}
