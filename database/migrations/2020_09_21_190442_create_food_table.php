<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->float('fat', 4, 2);
            $table->float('saturated_fat', 4, 2);
            $table->float('carbohydrate', 4, 2);
            $table->float('sugar', 4, 2);
            $table->float('protein', 4, 2);
            $table->boolean('animal');
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
        Schema::dropIfExists('food');
    }
}
