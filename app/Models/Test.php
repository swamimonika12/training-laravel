<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    //public $timestamps = false;

    //TABLE
    public $table = '';

    //FILLABLE
    protected $fillable = [];

    //HIDDEN
    protected $hidden = [];

    //APPENDS
    protected $appends = [];

    //WITH
    protected $with = [];

    //CASTS
    protected $casts = [];

    //RELATIONSHIPS
    //public function example(){
    //    return $this->hasMany();
    //}

    //ATTRIBUTES
    //public function getExampleAttribute()
    //{
    //    return $data;
    //}
    
}
