<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->string( 'first_name', 20 );
            $table->string( 'last_name_prefix', 20 )->nullable();
            $table->string( 'last_name', 20 );
            $table->enum( 'gender', ["M", "F"] );
            $table->string( 'username' , 20);
            $table->string( 'email' )
                  ->unique()
                  ->nullable();
            $table->string('image')->nullable();
            $table->integer( 'group' );
            $table->string( 'password' );
            $table->integer( 'teacher' )->unsigned()->nullable();
            $table->string( 'api_token', 60 )
                  ->unique()
                  ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign( 'teacher' )
                  ->references( 'id' )
                  ->on( 'user' );
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
        Schema::dropIfExists( 'user' );
        Schema::enableForeignKeyConstraints();
    }
}
