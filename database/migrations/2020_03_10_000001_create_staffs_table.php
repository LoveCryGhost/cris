<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_departments', function (Blueprint $table) {
            $table->bigIncrements('d_id')->unsigned();
            $table->bigInteger('p_id')->nullable()->default(0);

            $table->tinyInteger('sort_order')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->string('dp_code')->nullable();
            $table->string('processes');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('local')->default('zh-cn');
//            $table->foreign('p_id')->references('d_id')->on('staff_departments');
            $table->timestamps();
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('id_code')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->bigInteger('d_id')->nullable()->unsigned();
            $table->bigInteger('pic')->nullable()->unsigned();

            $table->tinyInteger('level')->default(0)->nullable();

            //面試日期
            $table->tinyInteger('sex')->nullable();

            $table->string('identify_code')->nullable()->unique();
            $table->string('photo_id1')->nullable();
            $table->string('photo_id2')->nullable();

            $table->string('tel1')->nullable();
            $table->string('phone1')->nullable();
            $table->string('contact1')->nullable();
            $table->string('tel2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('contact2')->nullable();

            $table->string('address_fix')->nullable();
            $table->string('address_current')->nullable();

            $table->string('introduction')->nullable();

            //面試日期
            $table->date('join_at')->nullable();
            //社保
            $table->date('social_security_at')->nullable();
            //申請離職日期
            $table->date('apply_for_leave_at')->nullable();
            //離職日期
            $table->date('leave_at')->nullable();

            //education
            $table->date('education1_from')->nullable();
            $table->date('education1_to')->nullable();
            $table->string('education1_level')->nullable();
            $table->string('school1_name')->nullable();

            $table->date('education2_from')->nullable();
            $table->date('education2_to')->nullable();
            $table->string('education2_level')->nullable();
            $table->string('school2_name')->nullable();

            //經歷
            $table->date('experience1_from')->nullable();
            $table->date('experience1_to')->nullable();
            $table->string('company1_name')->nullable();
            $table->integer('salary1')->nullable();

            $table->date('experience2_from')->nullable();
            $table->date('experience2_to')->nullable();
            $table->string('company2_name')->nullable();
            $table->integer('salary2')->nullable();


            $table->string('local')->nullable();
            $table->foreign('d_id')->references('d_id')->on('staff_departments')->onDelete('cascade');
            $table->foreign('pic')->references('id')->on('staffs')->onDelete('cascade');
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
        Schema::dropIfExists('staffs');
        Schema::dropIfExists('staff_departments');
    }
}
