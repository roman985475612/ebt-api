<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public static function getAll($isAdmin)
    {
        if($isAdmin) {
            return static::select([
                'id',
                'title',
                'status',
                'updated_at'
            ])->get();
        } else {
            return static::select([
                'title',
                'updated_at'
            ])->get();
        }
    }

    public static function findByTitle($s, $isAdmin)
    {
        if($isAdmin) {
            return static::select([
                'id',
                'title',
                'status',
                'updated_at'
            ])->where('title', 'LIKE', "%{$s}%")->get();
        } else {
            return static::select([
                'title',
                'updated_at'
            ])->where('title', 'LIKE', "%{$s}%")->get();
        }
    }

    public static function getOne($id, $isAdmin)
    {
        if($isAdmin) {
            return static::select([
                'id',
                'title',
                'body',
                'status',
                'updated_at'
            ])->findOrFail($id);
        } else {
            return static::select([
                'title',
                'body',
                'updated_at'
            ])->findOrFail($id);
        }
    }
}
