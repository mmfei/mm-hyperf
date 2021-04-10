<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $project_slot_id
 * @property int $project_id
 * @property string $slot_name
 * @property int $sort_index
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProjectSlot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_slot';
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
    protected $casts = ['project_slot_id' => 'integer', 'project_id' => 'integer', 'sort_index' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
