<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->integer('dp_id')->default(0);
            $table->string('dp_code')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('staff_id')->unsigned();
            $table->string('staff_code')->nullable();
            $table->bigInteger('d_id')->unsigned();
            $table->bigInteger('pic')->unsigned();

            $table->string('name');
            $table->string('avatar')->nullable();

            //面試日期
            $table->date('birthday')->nullable();
            $table->tinyInteger('sex');

            $table->string('identify_code')->unique();
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

            $table->string('description')->nullable();

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
            $table->foreign('pic')->references('staff_id')->on('staffs')->onDelete('cascade');
            $table->timestamps();
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
