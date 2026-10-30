<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip_hash',
        'path',
        'url',
        'page_title',
        'referer',
        'device',
        'browser',
        'platform',
        'locale',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfWeek());
    }

    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfMonth());
    }

    public function scopeLastDays(Builder $query, int $days = 30): Builder
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days)->startOfDay());
    }
}
