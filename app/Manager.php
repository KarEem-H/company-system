<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function employee()
    {
    	return $this->hasMany(Employee::class);
    }
    public function department()
    {
    	return $this->belongsTo(Department::class);
    }
}
