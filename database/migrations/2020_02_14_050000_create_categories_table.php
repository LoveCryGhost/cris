<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('c_id');
            $table->integer('c_pid')->default(0);
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('c_name')->unique();
            $table->string('c_description')->nullable();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');

    }
}
