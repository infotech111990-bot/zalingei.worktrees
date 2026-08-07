<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_colleges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->index();
            $table->unsignedBigInteger('college_id')->index();
            $table->timestamps();

            // Do NOT add foreign key constraints here to avoid migration failures if related tables differ on target environments.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_colleges');
    }
};
