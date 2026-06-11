<?php

namespace App\Models;

use Foxdb\Eloquent\Model;
use Foxdb\Eloquent\Concerns\HasSoftDeletes;

class User extends Model
{
    /**
     * The database table associated with this model.
     *
     * @var string
     */
    protected string $table = 'users';

    /**
     * The attributes that are mass-assignable.
     *
     * Only these fields can be set via create() or fill().
     * This protects against mass assignment attacks when passing
     * raw request data directly to the model.
     *
     * @var array<string>
     */
    protected array $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden from toArray() and toJson() output.
     *
     * Use this for sensitive fields that should never appear
     * in API responses or serialized data.
     *
     * @var array<string>
     */
    protected array $hidden = [
        'password',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native PHP types on read.
     *
     * Supported types: int, float, bool, string, array, object, datetime, immutable_datetime
     *
     * @var array<string, string>
     */
    protected array $casts = [
        'is_active'  => 'bool',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Soft deletes set a deleted_at timestamp instead of permanently
     * removing the record. Deleted users are excluded from all queries
     * by default and can be restored at any time.
     */
    use HasSoftDeletes;
}