<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    public $timestamps = false;

    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(Permissions::class, 'parent');
    }

    public function childs()
    {
        return $this->hasMany(Permissions::class, 'parent');
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'permission_role','permission_id');
    }
}
