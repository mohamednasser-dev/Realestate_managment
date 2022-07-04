<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projecttype_id')->unsigned();
            $table->foreign('projecttype_id')->references('id')->on('project_types')->onDelete('cascade');
            $table->bigInteger('mainclient_id')->unsigned();
            $table->foreign('mainclient_id')->references('id')->on('main_clients')->onDelete('cascade');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->bigInteger('id_num')->nullable();
            $table->bigInteger('check_num')->nullable();
            $table->date('check_date')->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('taxepercent');
            $table->bigInteger('total');
            $table->string('part_number');
            $table->string('scheme_number');
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
        Schema::dropIfExists('clients');
    }
}
