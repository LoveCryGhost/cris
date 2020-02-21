<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSupplierContactsTable extends Migration
{
    public function up()
    {
        Schema::create('supplier_contacts', function (Blueprint $table) {
            $table->bigIncrements('sc_id');
            $table->bigInteger('s_id')->unsigned();
            $table->string('id_code')->unique()->nullable();
            $table->string('sc_name');
            $table->string('name_card')->nullable();
            $table->string('tel')->nullable();
            $table->string('phone')->nullable();

            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('s_id')->references('s_id')->on('suppliers')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplier_contacts');
    }
}
