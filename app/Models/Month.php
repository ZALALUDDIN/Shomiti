<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Month extends Model
{
    use HasFactory, SoftDeletes;

    public function get_month()
    {
        return $this->hasMany(Receive::class);
    }
}
