<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    public $timestamps = false;
    protected $table = 'histories';
    //protected $visible = ['id','data'];
    public function Emploee()
    {
        return $this->belongsTo('App\Emploee', 'employees_id')->select(['id','fio']);
    }
}
