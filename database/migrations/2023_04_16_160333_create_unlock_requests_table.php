<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnlockRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unlock_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id');
            $table->foreignId('device_serial');
            $table->foreignId('user_id');
            $table->string('unlock_request_cost');
            $table->string('state');
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
        Schema::dropIfExists('unlock_requests');
    }
}
