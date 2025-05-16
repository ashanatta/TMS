<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('project_id','start_date','end_date','status')
                    ->withTimestamps();
    }
    


}
