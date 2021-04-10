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
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class ProjectInit extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // user , user_profile
        // project , project_owner , project_editor
        // project_slot , project_task , project_task_data , project_task_extra_data
        // project_task_user project_user

        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name', 256)->default('')->unique();
            $table->string('nickname', 256)->default('')->unique();
            $table->string('image_path', 256)->default('');
            $table->timestamps();
            $table->unique(['user_id'], 'u_project_user');
        });
        Schema::create('user_profile', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('email', 256)->default('')->unique();
            $table->string('phone', 256)->default('')->unique();
            $table->tinyInteger('is_email_check')->default(0);
            $table->tinyInteger('is_phone_check')->default(0);
            $table->tinyInteger('account_plat_id')->default(0)->comment('0:account,1:email,2:wechat,3:qq,');
            $table->string('open_id', 256)->default('');
            $table->timestamps();
        });
        Schema::create('user_auth', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('name', 256)->default('')->unique();
            $table->string('token', 256)->default('')->unique();
            $table->string('email', 256)->default('')->unique();
            $table->string('phone', 256)->default('')->unique();
            $table->string('password', 256)->default('');
            $table->string('password_salt', 256)->default('');
            $table->timestamps();
        });

        Schema::create('project', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->string('project_name', 256)->default('');
            $table->unsignedBigInteger('owner_user_id')->default(0);
            $table->unsignedInteger('sort_index')->default(0);
            $table->timestamps();
            $table->unique(['project_name'], 'u_name');
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->timestamps();
            $table->unique(['project_id', 'user_id'], 'u_project_user');
        });
        Schema::create('project_slot', function (Blueprint $table) {
            $table->bigIncrements('project_slot_id');
            $table->unsignedBigInteger('project_id')->default(0);
            $table->string('slot_name', 256)->default('');
            $table->unsignedInteger('sort_index')->default(0);
            $table->timestamps();
            $table->index(['slot_name'], 'u_name');
            $table->index(['project_id', 'slot_name'], 'u_project_slot');
        });

        Schema::create('project_task', function (Blueprint $table) {
            $table->bigIncrements('project_task_id');
            $table->unsignedBigInteger('project_id')->default(0);
            $table->unsignedBigInteger('project_slot_id')->default(0);
            $table->string('task_name', 256)->default('');
            $table->unsignedInteger('sort_index')->default(0);
            $table->timestamp('end_time')->comment('计划完成时间');
            $table->timestamps();
            $table->unique(['project_id', 'project_slot_id'], 'u_project_owner');
        });
        Schema::create('project_task_extra_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_task_id')->default(0);
            $table->string('desc_text', 256)->default('');
            $table->text('text');
            $table->timestamps();
            $table->index(['project_task_id'], 'project_task_id');
        });
        Schema::create('project_task_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_task_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedInteger('sort_index')->default(0);
            $table->timestamps();
            $table->unique(['project_task_id', 'user_id'], 'u_user_task');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('user_profile');
        Schema::dropIfExists('user_auth');
        Schema::dropIfExists('project');
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('project_slot');
        Schema::dropIfExists('project_task');
        Schema::dropIfExists('project_task_extra_data');
        Schema::dropIfExists('project_task_user');
    }
}
