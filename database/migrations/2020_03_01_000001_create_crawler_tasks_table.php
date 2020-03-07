<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_tasks', function (Blueprint $table) {
            $table->bigIncrements('ct_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(0);
            $table->tinyInteger('sort_order')->default(0);
            $table->string('ct_name');
            $table->string('url');
            $table->string('domain')->nullable();
            $table->string('pages')->default(2);
            $table->string('cat')->nullable();
            $table->string('sort_by')->nullable();
            $table->string('local')->nullable();
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
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
        Schema::dropIfExists('crawler_tasks');
    }
}
