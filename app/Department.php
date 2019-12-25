<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function employee()
    {
    	return $this->hasMany(Employee::class);
    }

    public function manager()
    {
    	return $this->hasMany(Manager::class);
    }
}
