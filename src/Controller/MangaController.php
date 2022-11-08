<?php

namespace App\Controller;

class MangaController extends AbstractController
{
    private $model;

    public function __construct()
    {
        $this->model = new MangaManager();
    }

    public function addManga(): void
    {
        if($_SERVER("REQUEST METHOD") === "POST")
        {
            $errors = [];

            $recipeManga = array_map('trim', $_POST);

            $this->validateData($recipeManga);

            if(empty($errors))
            {

            }

            
        }
    }

    public function validateData(array $arrayError): array
    {
        return $arrayError;
    }
}
