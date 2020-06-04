<?php

namespace KornerBI\UserManagement\Models;

use Illuminate\Database\Eloquent\Model;
use KornerBI\UserManagement\Permissions\HasPermissionsTrait;

class Role extends Model
{
    use HasPermissionsTrait;

    const ENTITY_ROUTE_PREFIX = '/roles/';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'users_roles');
    }
}
