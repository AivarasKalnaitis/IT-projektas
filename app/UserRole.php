<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_role';

    protected $fillable = [
        'user_id', 'role_id'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
