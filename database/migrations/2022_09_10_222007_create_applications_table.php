<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('json_data')->nullabel();
            $table->string('status')->default('pending');
            // $table->string('first_name');
            // $table->string('last_name');
            // $table->string('previous_degree');
            // $table->string('email');
            // $table->string('country');
            // $table->longText('phone');
            // $table->string('program');
            // $table->longText('file')->nullable();
            // $table->longText('message')->nullable();

            // $table->timestamp('date_of_birth');
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
        Schema::dropIfExists('applications');
    }
}
