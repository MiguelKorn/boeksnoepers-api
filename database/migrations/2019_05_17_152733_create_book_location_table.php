<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'book_location', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer('book_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->boolean( 'is_available' );

            $table->foreign( 'book_id' )
                  ->references( 'id' )
                  ->on( 'book' );

            $table->foreign( 'location_id' )
                  ->references( 'id' )
                  ->on( 'location' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists( 'book_location' );
        Schema::enableForeignKeyConstraints();
    }
}
