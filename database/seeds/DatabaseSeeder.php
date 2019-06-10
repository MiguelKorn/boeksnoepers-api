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
        // get and parse the books.json data
        $json            = File::get( "database/data/books.json" );
        $data            = json_decode( $json, true );
        $locations       = array();
        $books           = array();
        $questions       = array();
        $books_locations = array();

        // data specific data to array for easy push to db
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

        // remove tables
        DB::table( 'book_location' )->delete();
        DB::table( 'question' )->delete();
        DB::table( 'book' )->delete();
        DB::table( 'location' )->delete();

        // create tables and insert data
        ( ! is_null( $locations ) ) ? DB::table( 'location' )->insert( $locations ) : null;
        ( ! is_null( $books ) ) ? DB::table( 'book' )->insert( $books ) : null;
        ( ! is_null( $questions ) ) ? DB::table( 'question' )->insert( $questions ) : null;
        ( ! is_null( $locations ) && ! is_null( $books_locations ) ) ? DB::table( 'book_location' )->insert( $books_locations ) : null;

        // delete and insert competition data
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
                'name' => 'Mei 2019',
                'start_date' => Carbon::parse( '2019-05-01' ),
                'end_date' => Carbon::parse( '2019-05-31' )
            ],
            [
                'id' => 3,
                'name' => 'Juni 2019',
                'start_date' => Carbon::parse( '2019-06-01' ),
                'end_date' => Carbon::parse( '2019-06-30' )
            ]
        ] );

        // delete and insert user data
        DB::table( 'user' )->delete();
        DB::table( 'user' )->insert( [
            [ 'id' => '1', 'first_name' => 'Roos', 'last_name_prefix' => 'de', 'last_name' => 'Jong', 'gender'=>'F','username' => 'jongr', 'email' => 'jongr@boeksnoepers.nl', 'image'=>null,'group' => '5', 'password' => bcrypt('jongr'), 'teacher' => null, 'highest_place'=>null],
            [ 'id' => '2', 'first_name' => 'Daan', 'last_name_prefix' => null, 'last_name' => 'Jansen', 'gender'=>'M','username' => 'jansd', 'email' => null, 'image'=>'2.png','group' => '5', 'password' => bcrypt('jansd'), 'teacher' => 1, 'highest_place'=>1 ],
            [ 'id' => '3', 'first_name' => 'Anna', 'last_name_prefix' => 'de','last_name' => 'Vries', 'gender'=>'F','username' => 'vriesa', 'email' => null, 'image'=>'3.png','group' => '5', 'password' => bcrypt('vriesa'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '4', 'first_name' => 'Noah', 'last_name_prefix' => 'van den','last_name' => 'Berge', 'gender'=>'M','username' => 'bergen', 'email' => null, 'image'=>'4.png','group' => '5', 'password' => bcrypt('bergen'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '5', 'first_name' => 'Emma', 'last_name_prefix' => 'van','last_name' => 'Dijk', 'gender'=>'F','username' => 'dijke', 'email' => null, 'image'=>'5.png','group' => '5', 'password' => bcrypt('dijke'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '6', 'first_name' => 'Ruben', 'last_name_prefix' => null, 'last_name' => 'Visser', 'gender'=>'M','username' => 'visser', 'email' => null, 'image'=>'6.png','group' => '5', 'password' => bcrypt('visser'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '7', 'first_name' => 'Tess', 'last_name_prefix' => null, 'last_name' => 'Smit', 'gender'=>'F','username' => 'smitt', 'email' => null, 'image'=>'7.png','group' => '5', 'password' => bcrypt('smitt'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '8', 'first_name' => 'Robin', 'last_name_prefix' => null, 'last_name' => 'Meijer', 'gender'=>'M','username' => 'meijer', 'email' => null, 'image'=>'8.png','group' => '5', 'password' => bcrypt('meijer'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '9', 'first_name' => 'Sophie', 'last_name_prefix' => 'de','last_name' => 'Boer', 'gender'=>'F','username' => 'boers', 'email' => null, 'image'=>'9.png','group' => '5', 'password' => bcrypt('boers'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '10', 'first_name' => 'Finn', 'last_name_prefix' => null, 'last_name' => 'Bos', 'gender'=>'M','username' => 'bosf', 'email' => null, 'image'=>'10.png','group' => '5', 'password' => bcrypt('bosf'), 'teacher' => 1, 'highest_place'=>null ],
            [ 'id' => '11', 'first_name' => 'Julia', 'last_name_prefix' => 'van','last_name' => 'Leeuwen', 'gender'=>'F','username' => 'leeuwj', 'email' => null, 'image'=>'11.png','group' => '5', 'password' => bcrypt('leeuwj'), 'teacher' => 1, 'highest_place'=>null ],
        ] );

        // delete and insert user_book data
        DB::table( 'user_book' )->delete();
        DB::table( 'user_book' )->insert( [
            [ 'id' => 1, 'user_id' => 2, 'book_id' => 3, 'competition_id' => 1, 'is_current' => false, 'score' => 3 ],
            [ 'id' => 2, 'user_id' => 2, 'book_id' => 4, 'competition_id' => 1, 'is_current' => false, 'score' => 3 ],
            [ 'id' => 3, 'user_id' => 2, 'book_id' => 1, 'competition_id' => 2, 'is_current' => true, 'score' => null ],
            [ 'id' => 4, 'user_id' => 3, 'book_id' => 2, 'competition_id' => 2, 'is_current' => false, 'score' => 5 ],
            [ 'id' => 5, 'user_id' => 2, 'book_id' => 3, 'competition_id' => 2, 'is_current' => false, 'score' => 3 ],
            [ 'id' => 6, 'user_id' => 2, 'book_id' => 2, 'competition_id' => 3, 'is_current' => true, 'score' => null ],
            [ 'id' => 7, 'user_id' => 3, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 5 ],
            [ 'id' => 8, 'user_id' => 5, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 4 ],
            [ 'id' => 9, 'user_id' => 6, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 3 ],
            [ 'id' => 10, 'user_id' => 9, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 2 ],
            [ 'id' => 11, 'user_id' => 4, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 1 ],
            [ 'id' => 12, 'user_id' => 7, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 1 ],
            [ 'id' => 13, 'user_id' => 8, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 1 ],
            [ 'id' => 14, 'user_id' => 10, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 1 ],
            [ 'id' => 15, 'user_id' => 11, 'book_id' => 2, 'competition_id' => 3, 'is_current' => false, 'score' => 1 ],

        ] );
    }
}
