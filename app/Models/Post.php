<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'body',
        'color',
        'active',
        'promoted',
        'created_at',
        'updated_at',
    ];

    public $colors = [
        ["name" => ""],
        ["name" => "is-primary"],
        ["name" => "is-link"],
        ["name" => "is-info"],
        ["name" => "is-success"],
        ["name" => "is-warning"],
        ["name" => "is-danger"],
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getColorNameAttribute()
    {
        if (empty($this->color))
            $this->color = 0;

        return $this->colors[$this->color]["name"];
    }

    public function scopeActive($query)
    {
        $query->where(function ($query) {
            $query->where('active', '=', 1);
        });
    }

    public function scopePromoted($query)
    {
        $query->where(function ($query) {
            $query->where('promoted', '=', 1);
        });
    }
}
