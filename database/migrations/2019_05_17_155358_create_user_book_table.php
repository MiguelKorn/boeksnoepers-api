<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user_book', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'book_id' )->unsigned();
            $table->integer( 'competition_id' )->unsigned();
            $table->boolean( 'is_current' )->default( true );
            $table->decimal( 'score', 1, 0 )->nullable();
            $table->timestamps();

            $table->foreign( 'user_id' )
                  ->references( 'id' )
                  ->on( 'user' );

            $table->foreign( 'book_id' )
                  ->references( 'id' )
                  ->on( 'book' );

            $table->foreign( 'competition_id' )
                  ->references( 'id' )
                  ->on( 'competition' );
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
        Schema::dropIfExists( 'user_book' );
        Schema::enableForeignKeyConstraints();
    }
}
