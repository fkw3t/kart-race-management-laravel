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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_start');
            $table->dateTime('data_end')->nullable();
            $table->tinyInteger('laps');
            $table->enum('difficulty', [
                'very-easy',
                'easy',
                'medium',
                'difficult',
                'very-difficult'
            ]);
            $table->string('local');
            $table->string('number_runners');
            $table->enum('status', [
                'scheduled',
                'running',
                'finished'
            ])->default('scheduled');
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
        Schema::dropIfExists('races');
    }
};
