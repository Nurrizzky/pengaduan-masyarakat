<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    //
    protected $fillable = [
        'report_id',
        'staff_id',
        'response_status',
    ];

    public function responseProgress(): HasMany
    {
        return $this->hasMany(ResponseProgres::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
