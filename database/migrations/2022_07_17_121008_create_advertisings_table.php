<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisings', function (Blueprint $table) {
            $table->id();
            $table->string('ar_title');
            $table->string('en_title');
            $table->longText('ar_description')->nullable();
            $table->longText('en_description')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('is_visible')->default(1);
            $table->integer('is_favorite')->default(0);
            $table->string('space')->nullable();
            $table->string('price')->nullable();
            $table->string('soom')->nullable();
            $table->string('peace_number')->nullable();
            $table->string('image')->nullable();
            $table->integer('view')->default(0);
            $table->integer('rooms_count')->nullable();
            $table->foreignId('main_category_id')->constrained('main_categories')->restrictOnDelete();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->restrictOnDelete();
            $table->foreignId('city_id')->constrained('cities')->restrictOnDelete();
            $table->foreignId('district_id')->constrained('districts')->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
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
        Schema::dropIfExists('advertisings');
    }
}
