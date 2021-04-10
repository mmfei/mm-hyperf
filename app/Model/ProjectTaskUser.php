<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id
 * @property int $project_task_id
 * @property int $user_id
 * @property int $sort_index
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProjectTaskUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_task_user';
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
    protected $casts = ['id' => 'integer', 'project_task_id' => 'integer', 'user_id' => 'integer', 'sort_index' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
