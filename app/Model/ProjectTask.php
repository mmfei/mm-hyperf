<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $project_task_id
 * @property int $project_id
 * @property int $project_slot_id
 * @property string $task_name
 * @property int $sort_index
 * @property string $end_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProjectTask extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_task';
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
    protected $casts = ['project_task_id' => 'integer', 'project_id' => 'integer', 'project_slot_id' => 'integer', 'sort_index' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
