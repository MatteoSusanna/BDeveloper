<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();

            $table->string('curriculum')->nullable();
            $table->char('phone', 12)->nullable();
            $table->string('cover')->nullable();
            $table->decimal('hourly_wage', 5, 2)->nullable();
            $table->string('slug', 255)->unique()->default('1');



        
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
        Schema::dropIfExists('data');
    }
}
