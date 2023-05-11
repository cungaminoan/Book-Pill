<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre')->insert(array(
            array(
                'genre_name' => 'Science Fiction',
            ),
            array(
                'genre_name' => 'Action'
            ),
            array(
                'genre_name' => 'Fantasy'
            ),
            array(
                'genre_name' => 'Light Novel'
            ),
            array(
                'genre_name' => 'Romance'
            ),
            array(
                'genre_name' => 'Drama'
            ),
            array(
                'genre_name' => 'Folk Tales'
            ),
            array(
                'genre_name' => 'Legends & Mythology'
            ),
            array(
                'genre_name' => 'Sci-fi'
            ),
            array(
                'genre_name' => 'Thriller'
            ),
            array(
                'genre_name' => 'Novel'
            ),
            array(
                'genre_name' => 'Classic'
            ),
            array(
                'genre_name' => 'Philosophy'
            ),
            array(
                'genre_name' => 'Poet'
            ),
            array(
                'genre_name' => 'Historical'
            ),
            array(
                'genre_name' => 'Manga'
            ),
            array(
                'genre_name' => 'Game'
            ),
            array(
                'genre_name' => 'Fiction'
            ),
            array(
                'genre_name' => 'Art'
            ),
            array(
                'genre_name' => 'Literature'
            ),
            array(
                'genre_name' => 'Dystopia'
            ),
            array(
                'genre_name' => 'Mystery'
            ),
            array(
                'genre_name' => 'Psychologically'
            ),
            array(
                'genre_name' => 'Super Natural'
            ),
            array(
                'genre_name' => 'Technology'
            ),
            array(
                'genre_name' => 'Programming'
            ),
            array(
                'genre_name' => 'Education'
            ),
            array(
                'genre_name' => 'Math'
            ),
            array(
                'genre_name' => 'Science'
            ),
            array(
                'genre_name' => 'Nonfiction'
            ),
            array(
                'genre_name' => 'Quantum Mechanics'
            ),
            array(
                'genre_name' => 'Physics'
            ),
            array(
                'genre_name' => 'Crime'
            ),
            array(
                'genre_name' => 'Historical Fiction'
            ),
            array(
                'genre_name' => 'Self Help'
            ),
            array(
                'genre_name' => 'Business'
            ),
            array(
                'genre_name' => 'Horror'
            ),
            array(
                'genre_name' => 'Young Adult'
            ),
            array(
                'genre_name' => 'Magic'
            ),
            array(
                'genre_name' => 'Adventure'
            ),
            array(
                'genre_name' => 'Paranormal'
            ),
            array(
                'genre_name' => 'Magical Realism'
            ),
            array(
                'genre_name' => 'Cookbook'
            ),
            array(
                'genre_name' => 'Food'
            ),
            array(
                'genre_name' => 'Culinary'
            ),
        ));
    }
}
