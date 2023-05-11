<?php

namespace App\Service\Repository\Eloquent;

use App\Models\Genre;
use App\Service\Repository\GenreRepositoryInterface;

class GenreRepository implements GenreRepositoryInterface
{

    private Genre $genre;

    /**
     */
    public function __construct()
    {
        $this->genre = new Genre();
    }

    public function getGenreByProduct($genreProduct)
    {
        try {
            return $this->genre->whereIn('id', $genreProduct)->orderBy('genre_name')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getGenre()
    {
        try {
            return $this->genre->orderBy('genre_name')->get();
        } catch (\Exception $e) {
            return false;
        }
    }
}
