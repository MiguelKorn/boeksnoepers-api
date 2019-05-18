<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $json            = File::get( "database/data/books.json" );
        $data            = json_decode( $json, true );
        $locations       = array();
        $books           = array();
        $questions       = array();
        $books_locations = array();

        foreach ( $data['books'][0]['availability'] as $key => $location ) {
            array_push( $locations, [
                'id' => $key + 1,
                'name' => $location['location']
            ] );
        }

        foreach ( $data['books'] as $key => $item ) {
            array_push( $books, [
                'id' => $item['id'],
                'title' => $item['title'],
                'description' => $item['description'],
                'image' => $item['img']
            ] );

            foreach ( $item['questions'] as $qKey => $question ) {
                array_push( $questions, [
                    'id' => count( $questions ) + 1,
                    'book_id' => $item['id'],
                    'order' => $qKey + 1,
                    'title' => $question['title'],
                    'correct_answer' => $question['answer'],
                    'answer_a' => $question['options']['A'],
                    'answer_b' => $question['options']['B'],
                    'answer_c' => $question['options']['C']
                ] );
            }

            foreach ( $item['availability'] as $aKey => $location ) {
                array_push( $books_locations, [
                    'id' => count( $books_locations ) + 1,
                    'book_id' => $item['id'],
                    'location_id' => $aKey + 1,
                    'is_available' => $location['available']
                ] );
            }
        }

        DB::table( 'book_location' )->delete();
        DB::table( 'question' )->delete();
        DB::table( 'book' )->delete();
        DB::table( 'location' )->delete();

        ( ! is_null( $locations ) ) ? DB::table( 'location' )->insert( $locations ) : null;
        ( ! is_null( $books ) ) ? DB::table( 'book' )->insert( $books ) : null;
        ( ! is_null( $questions ) ) ? DB::table( 'question' )->insert( $questions ) : null;
        ( ! is_null( $locations ) && ! is_null( $books_locations ) ) ? DB::table( 'book_location' )->insert( $books_locations ) : null;

        DB::table( 'competition' )->delete();
        DB::table( 'competition' )->insert( [
            [
                'id' => 1,
                'name' => 'April 2019',
                'start_date' => Carbon::parse( '2019-04-01' ),
                'end_date' => Carbon::parse( '2019-04-30' )
            ],
            [
                'id' => 2,
                'name' => 'April 2019',
                'start_date' => Carbon::parse( '2019-05-01' ),
                'end_date' => Carbon::parse( '2019-05-31' )
            ]
        ] );

        DB::table( 'user' )->delete();
        DB::table( 'user' )->insert( [
            [ 'id' => '1', 'first_name' => 'Roos', 'last_name_prefix' => 'de', 'last_name' => 'Jong', 'username' => 'jongr', 'email' => 'jongr@boeksnoepers.nl', 'group' => '5', 'password' => bcrypt('jongr'), 'teacher' => null],
            [ 'id' => '2', 'first_name' => 'Daan', 'last_name_prefix' => null, 'last_name' => 'Jansen', 'username' => 'jansd', 'email' => null, 'group' => '5', 'password' => bcrypt('jansd'), 'teacher' => 1 ],
            [ 'id' => '3', 'first_name' => 'Anna', 'last_name_prefix' => 'de','last_name' => 'Vries', 'username' => 'vriesa', 'email' => null, 'group' => '5', 'password' => bcrypt('vriesa'), 'teacher' => 1 ],
            [ 'id' => '4', 'first_name' => 'Noah', 'last_name_prefix' => 'van den','last_name' => 'Berge', 'username' => 'bergen', 'email' => null, 'group' => '5', 'password' => bcrypt('bergen'), 'teacher' => 1 ],
            [ 'id' => '5', 'first_name' => 'Emma', 'last_name_prefix' => 'van','last_name' => 'Dijk', 'username' => 'dijke', 'email' => null, 'group' => '5', 'password' => bcrypt('dijke'), 'teacher' => 1 ],
            [ 'id' => '6', 'first_name' => 'Ruben', 'last_name_prefix' => null, 'last_name' => 'Visser', 'username' => 'visser', 'email' => null, 'group' => '5', 'password' => bcrypt('visser'), 'teacher' => 1 ],
            [ 'id' => '7', 'first_name' => 'Tess', 'last_name_prefix' => null, 'last_name' => 'Smit', 'username' => 'smitt', 'email' => null, 'group' => '5', 'password' => bcrypt('smitt'), 'teacher' => 1 ],
            [ 'id' => '8', 'first_name' => 'Ruben', 'last_name_prefix' => null, 'last_name' => 'Meijer', 'username' => 'meijer', 'email' => null, 'group' => '5', 'password' => bcrypt('meijer'), 'teacher' => 1 ],
            [ 'id' => '9', 'first_name' => 'Sophie', 'last_name_prefix' => 'de','last_name' => 'Boer', 'username' => 'boers', 'email' => null, 'group' => '5', 'password' => bcrypt('boers'), 'teacher' => 1 ],
            [ 'id' => '10', 'first_name' => 'Finn', 'last_name_prefix' => null, 'last_name' => 'Bos', 'username' => 'bosf', 'email' => null, 'group' => '5', 'password' => bcrypt('bosf'), 'teacher' => 1 ],
            [ 'id' => '11', 'first_name' => 'Julia', 'last_name_prefix' => 'van','last_name' => 'Leeuwen', 'username' => 'leeuwj', 'email' => null, 'group' => '5', 'password' => bcrypt('leeuwj'), 'teacher' => 1 ],
        ] );

        DB::table( 'user_book' )->delete();
        DB::table( 'user_book' )->insert( [
            ['id'=>1, 'user_id'=>2, 'book_id'=>1, 'competition_id'=>2, 'is_current'=>true, 'score'=>null],
            ['id'=>2, 'user_id'=>3, 'book_id'=>2, 'competition_id'=>2, 'is_current'=>false, 'score'=>5]
        ]);
//        $table->increments( 'id' );
//        $table->integer( 'user_id' )->unsigned();
//        $table->integer( 'book_id' )->unsigned();
//        $table->integer( 'competition_id' )->unsigned();
//        $table->boolean( 'is_current' )->default( true );
//        $table->decimal( 'score', 1, 0 )->nullable();
//        $table->timestamps();
    }
}
