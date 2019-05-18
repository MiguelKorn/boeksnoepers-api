<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'question', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'book_id' )->unsigned();
            $table->decimal( 'order', 1, 0 );
            $table->string( 'title', 255 );
            $table->enum( 'correct_answer', [ 'A', 'B', 'C' ] );
            $table->string( 'answer_a', 50 );
            $table->string( 'answer_b', 50 );
            $table->string( 'answer_c', 50 );

            $table->foreign( 'book_id' )
                  ->references( 'id' )
                  ->on( 'book' );
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
        Schema::dropIfExists( 'question' );
        Schema::enableForeignKeyConstraints();
    }
}
