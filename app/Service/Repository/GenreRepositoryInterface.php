<?php

namespace App\Service\Repository;

interface GenreRepositoryInterface
{

    public function getGenre();

    public function getGenreByProduct($genreProduct);
}
