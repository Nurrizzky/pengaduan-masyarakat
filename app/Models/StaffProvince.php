<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffProvince extends Model
{
    //
protected $fillable = [
        'user_id',
        'province',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
