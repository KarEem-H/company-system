<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function manager()
    {
        return $this->hasMany(Manager::class);
    }
}
