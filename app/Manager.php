<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name' ,'department_id'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
