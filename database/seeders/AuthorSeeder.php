<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author')->insert(array(
            array(
                'author_name' => 'Haimura Kiyotaka'
            ),
            array(
                'author_name' => 'Haruki Murakami'
            ),
            array(
                'author_name' => 'Han Christian Andersen'
            ),
            array(
                'author_name' => 'Jules Verne'
            ),
            array(
                'author_name' => 'Jacob & Wilhelm Grimm'
            ),
            array(
                'author_name' => 'Lev Nikolayevich Tolstoy'
            ),
            array(
                'author_name' => 'Fyodor Mikhailovich Dostoyevsky'
            ),
            array(
                'author_name' => 'Alexander Pushkin'
            ),
            array(
                'author_name' => 'Victor Hugo'
            ),
            array(
                'author_name' => 'Mashashi Kishimoto'
            ),
            array(
                'author_name' => 'Riot Games'
            ),
            array(
                'author_name' => 'Jun Eishima'
            ),
            array(
                'author_name' => 'Yusuke Kishi'
            ),
            array(
                'author_name' => 'Tsugumi Ohba'
            ),
            array(
                'author_name' => 'Antonio Leiva'
            ),
            array(
                'author_name' => 'Dan Halminton'
            ),
            array(
                'author_name' => 'Georgi E. Shilov'
            ),
            array(
                'author_name' => 'Kai Lai Chung'
            ),
            array(
                'author_name' => 'Carl J. Pratt'
            ),
            array(
                'author_name' => 'Brian Greene'
            ),
            array(
                'author_name' => 'Yuval Noah Harari'
            ),
            array(
                'author_name' => 'Agatha Christie'
            ),
            array(
                'author_name' => 'Margaret Mitchell'
            ),
            array(
                'author_name' => 'Daniel Kahneman'
            ),
            array(
                'author_name' => 'Stephen R. Covey'
            ),
            array(
                'author_name' => 'Minato Kanae'
            ),
            array(
                'author_name' => 'Stephen King'
            ),
            array(
                'author_name' => 'Sarah J Mash'
            ),
            array(
                'author_name' => 'J.R.R Tolken'
            ),
            array(
                'author_name' => 'Suzanne Collins'
            ),
            array(
                'author_name' => 'Veronica Roth'
            ),
            array(
                'author_name' => 'William Peter Blatty'
            ),
            array(
                'author_name' => 'Sir Arthur Conan Doyle'
            ),
            array(
                'author_name' => 'Higashino Keigo'
            ),
            array(
                'author_name' => 'Nicholas Sparks'
            ),
            array(
                'author_name' => 'Alan Witschonke'
            ),
            array(
                'author_name' => 'Haruki Murakami'
            ),
            array(
                'author_name' => 'Jay Asher'
            )
        ));
    }
}
