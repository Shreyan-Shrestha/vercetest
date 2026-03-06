<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
    protected $fillable = ['image','projectname','clientname','status','description','category','location','startdate','completeddate'];
}
