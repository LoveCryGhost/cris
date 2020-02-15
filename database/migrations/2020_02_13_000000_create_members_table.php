<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_code')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('introduction')->nullable();
            $table->bigInteger('admin_id')->nullable()->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('member_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id')->unsigned();
            $table->boolean('agent')->default(1);
            $table->string('browser')->nullable();
            $table->string('ip')->unique();
            $table->string('device')->nullable();
            $table->date('platform')->nullable();
            $table->string('language')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('member_login_logs');
        Schema::dropIfExists('members');
    }
}
