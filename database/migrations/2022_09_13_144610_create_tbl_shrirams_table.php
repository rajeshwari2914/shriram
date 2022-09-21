<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblShriramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_shrirams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('desc');
            $table->string('estri');
            $table->string('ring');
            $table->string('pendri');
            $table->string('order_date');
            $table->string('delivery_date');
            $table->string('shirt_qty');
            $table->string('paint_qty');
            $table->string('total_amt');
            $table->string('advance_amt');
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
        Schema::dropIfExists('tbl_shrirams');
    }
}
