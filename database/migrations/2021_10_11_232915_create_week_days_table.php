<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('EventName', 500)->nullable(false);
            $table->date('DateFrom');
            $table->date('DateTo');
            $table->boolean("Mon")->default(false);
            $table->boolean("Tue")->default(false);
            $table->boolean("Wed")->default(false);
            $table->boolean("Thu")->default(false);
            $table->boolean("Fri")->default(false);
            $table->boolean("Sat")->default(false);
            $table->boolean("Sun")->default(false);
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
        Schema::dropIfExists('week_days');
    }
}
