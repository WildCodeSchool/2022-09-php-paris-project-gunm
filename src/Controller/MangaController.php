<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\MangaManager;

class MangaController extends AbstractController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manga = array_map('trim', $_POST);
            $errors = [];

            if (empty(trim($_POST['title'])) && strlen($_POST['title']) >= 100) {
                $errors[] = 'Le champ titre doit être rempli';
            }

            if (empty(trim($_POST['autor'])) && strlen($_POST['author']) >= 100) {
                $errors[] = 'Le champ auteur doit être rempli';
            }

            if (empty(trim($_POST['description']))) {
                $errors[] = 'Le champ description doit être rempli';
            }

            if (empty(trim($_POST['released_at']))) {
                $errors[] = 'Le champ date de parution doit être rempli';
            }

            if (empty(trim($_POST['category'])) && strlen($_POST['category']) >= 100) {
                $errors[] = 'Le champ categorie doit être rempli';
            } elseif (empty($errors)) {
                $mangaManager = new MangaManager();
                $mangaManager->addManga($manga);

                header('Location:/showcase/show?id=');
            } else {
                foreach ($errors as $error) {
                    echo $error;
                }
            }
        }
    }

    public function addPicture()
    {
        $mangaImage = array_map('trim', $_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            define('MAX_SIZE', 10000);
            define('WIDTH_MAX', 800);
            define('HEIGHT_MAX', 800);
            define('EXTENSION', ['jpg','gif','png','jpeg']);

            if (isset($_FILES['image']) && empty($_FILES['image'])) {
                $errors[] = 'L\'image est obligatoire';
            }
        } elseif (
            $_FILES['image'] > MAX_SIZE || $_FILES['image'] > WIDTH_MAX
            || $_FILES['image'] > HEIGHT_MAX
        ) {
            $errors[] = 'La taille de l\'image est trop volumineuse';
        } elseif (!in_array(EXTENSION, EXTENSION)) {
            $errors[] = 'Le format n\'est pas accepté';
        } elseif (empty($errors)) {
            $mangaManager = new MangaManager();
            $mangaManager->addManga($mangaImage);

            header('Location:/showcase/show?id=');
        } else {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    }
}
