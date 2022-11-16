<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\MangaManager;
use DateTime;

class MangaController extends AbstractController
{
    public function show()
    {
        return $this->twig->render('Manga/add.html.twig');
    }

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manga = array_map('trim', $_POST);

            if (empty($manga['title']) || strlen($manga['title']) < 5 || strlen($manga['title']) > 100) {
                $errors[] = 'Le champ titre est vide ou n\'a pas été correctement rempli';
            }

            if (empty(($manga['author'])) || strlen($manga['author']) < 5 || strlen($manga['author']) > 100) {
                $errors[] = 'Le champ auteur est vide ou n\'a pas été correctement rempli';
            }

            if (empty($manga['description']) || strlen($manga['description']) > 1000) {
                $errors[] = 'Le champ description est vide ou ne doit pas dépasser 1000 caractères';
            }

            if (empty($manga['released_at']) || !$this->validateDate($manga['released_at'])) {
                $errors[] = 'Le champ date est vide ou n\'a pas été correctement rempli';
            }

            if (empty($manga['category']) || strlen($manga['category']) < 5 || strlen($manga['category']) > 100) {
                $errors[] = 'Le champ categorie est vide ou n\'a pas été correctement rempli';
            }

            $errors = array_merge($errors, $this->checkImage());

            if (empty($errors)) {
                $fileName = basename($_FILES["image"]["name"]);
                $filePath = $_SERVER['DOCUMENT_ROOT'] . '/../public/uploads/' . $fileName;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $filePath)) {
                    $manga['image'] = $filePath;
                    $mangaManager = new MangaManager();
                    $mangaManager->addManga($manga);

                    header('Location: /');
                }
            }
        }

        return $this->twig->render('Manga/add.html.twig', [
            'errors' => $errors
        ]);
    }

    private function checkImage()
    {
        $errors = [];
        if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
            $errors[] = 'L\'image est obligatoire';
        } else {
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if ($_FILES['image']['size'] > MAX_SIZE_MANGA_IMAGE) {
                $errors[] = 'La taille de l\'image est trop volumineuse';
            }

            if (!in_array($extension, ALLOWED_EXTENSIONS_MANGA_IMAGE)) {
                $errors[] = 'Le format n\'est pas accepté';
            }
        }

        return $errors;
    }

    private function validateDate($date, $format = 'Y-m-d'): bool
    {
        $dateFormat = DateTime::createFromFormat($format, $date);
        return $dateFormat && $dateFormat->format($format) == $date;
    }
}
