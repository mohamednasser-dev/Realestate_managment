<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAdvertisings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisings', function (Blueprint $table) {
            $table->integer('plate_number')->after('peace_number')->nullable();
            $table->string('information')->after('plate_number')->nullable();
            $table->enum('active_location',['active','inactive'])->after('information')->default('inactive');
            $table->string('key')->nullable()->after('active_location');
            $table->string('status')->after('view')->default(0);
            $table->foreignId('owner_id')->nullable()->constrained('owners')->nullOnDelete();
            $table->string('video_link')->nullable();
            $table->string('build_area')->nullable();
            $table->string('build_age')->nullable();
            $table->string('district_area')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisings', function (Blueprint $table) {
            //
        });
    }
}
