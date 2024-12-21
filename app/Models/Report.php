<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'voting',
        'viewers',
        'image',
        'statement',
    ];

    // Casting data JSON dan Boolean
    protected $casts = [
        'voting' => 'array',
        'statement' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        // 1 report punya banyak comment
        // 1 to many
        return $this->hasMany(Comment::class, 'report_id')->latest();
    }

    public function response() {
        return $this->hasOne(Response::class, 'report_id', 'id');
    }
}
