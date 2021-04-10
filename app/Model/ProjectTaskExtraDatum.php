<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id
 * @property int $project_task_id
 * @property string $desc_text
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProjectTaskExtraDatum extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_task_extra_data';
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
    protected $casts = ['id' => 'integer', 'project_task_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
