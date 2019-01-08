<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Emploee extends Model
{

    public $timestamps = false;
    protected $table = 'employees';
    public function historyAll() {
        return $this->hasMany('App\History', 'employees_id');
    }

    public  function history()
    {
        return $this->belongsToMany('App\Models\Device','histories',
                'employees_id', 'device_iddevice');
    }

}
