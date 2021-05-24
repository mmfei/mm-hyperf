<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

/**
 * @property int $user_id
 * @property string $email
 * @property string $phone
 * @property int $is_email_check
 * @property int $is_phone_check
 * @property int $account_plat_id
 * @property string $open_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class UserProfile extends Model
{
    protected $primaryKey = 'user_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profile';

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
    protected $casts = ['user_id' => 'integer', 'is_email_check' => 'integer', 'is_phone_check' => 'integer', 'account_plat_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
