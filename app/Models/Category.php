<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $guarded = ['id'];
    protected $fillable=['name'];
    public function device()
    {
        return $this->hasMany('App\Device', 'category_idcategory', 'id');
    }

}
