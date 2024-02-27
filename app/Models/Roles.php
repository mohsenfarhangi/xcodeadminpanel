<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $guarded = [];

    public $timestamps = false;

    public function admins(): MorphToMany
    {
        return $this->morphedByMany(Admins::class, 'roleable' )->withPivot('status');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(Users::class, 'roleable' )->withPivot('status');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permissions::class,'permission_role','role_id','permission_id');
    }
}
