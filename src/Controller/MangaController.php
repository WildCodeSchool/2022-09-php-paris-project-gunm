<?php

namespace App\Controller;

class MangaController extends AbstractController
{
    public function addManga(): void
    {
        if ($_SERVER("REQUEST METHOD") === "POST") {
            $recipeManga = array_map('trim', $_POST);
            $this->validateData($recipeManga);
        }
    }
    public function validateData(array $arrayError): array
    {
        return $arrayError;
    }
}
