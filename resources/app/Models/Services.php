<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'icon',
        'title',
        'description',
    ];
    use SoftDeletes;
}
