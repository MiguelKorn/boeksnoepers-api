<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'book', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->string( 'title', 50 );
            $table->mediumText( 'description' );
            $table->string( 'image', 255 );
            $table->timestamps();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'book' );
    }
}
