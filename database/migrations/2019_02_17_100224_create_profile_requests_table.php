<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('foreign_id');
            $table->boolean('allow')->default(false);
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
        Schema::dropIfExists('profile_requests');
    }
}
