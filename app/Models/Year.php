<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Year extends Model
{
    use HasFactory,SoftDeletes;

    public function year()
    {
        return $this->hasMany(Receive::class, Report::class);
    }
}
