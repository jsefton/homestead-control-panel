<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomesteadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homesteads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('box_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('yaml_location')->nullable();
            $table->string('vagrant_file_location')->nullable();
            $table->integer('cpus')->nullable();
            $table->integer('memory')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homesteads');
    }
}
