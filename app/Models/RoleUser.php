<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    /**
     * Object table name.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * Disable insert timestamps records.
     *
     * @var bool
     */
    public $timestamps = false;
}
