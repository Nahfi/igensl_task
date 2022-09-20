<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFormElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_form_elements', function (Blueprint $table) {
            $table->id();
            $table->string('input_name');
            $table->string('input_type');
            $table->longText('input_value')->nullable();
            $table->string('is_required')->nullable();
            $table->string('is_country')->nullable();
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('application_form_elements');
    }
}
