<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Receive;
class Member extends Model
{
    use HasFactory, SoftDeletes;

    public function member()
    {
        return $this->hasMany('member_id');
    }
}
