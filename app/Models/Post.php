<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //public $timestamps = false;

    //TABLE
    public $table = 'posts';

    //FILLABLE
    protected $fillable = [
        'member_id',
        'title',
        'description',
        'gender',
    ];

    //HIDDEN
    protected $hidden = [];

    //APPENDS
    protected $appends = [];

    //WITH
    protected $with = [];

    //CASTS
    protected $casts = [];

    //RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    //ATTRIBUTES
    //public function getExampleAttribute()
    //{
    //    return $data;
    //}

}
