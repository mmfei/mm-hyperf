<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $project_id
 * @property string $project_name
 * @property int $owner_user_id
 * @property int $sort_index
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['project_id' => 'integer', 'owner_user_id' => 'integer', 'sort_index' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
