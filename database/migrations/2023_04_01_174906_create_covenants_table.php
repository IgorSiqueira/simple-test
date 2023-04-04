<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custumer_id')->constrained('custumers');
            $table->decimal('debt_amount',9,2);
            $table->dateTime('debt_due_date');
            $table->bigInteger('external_id');
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
        Schema::dropIfExists('covenants');
    }
}
