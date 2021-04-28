<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'status'];

    public static function findByTitle($s)
    {
        return static::where('title', 'LIKE', "%{$s}%")->get();
    }
}
