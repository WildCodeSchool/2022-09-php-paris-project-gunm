<?php

namespace App\Controller;

use App\Model\MangaManager;

class MangaController extends AbstractController
{
    private MangaManager $mangaManager;
    public function __construct()
    {
        parent::__construct();
        $this->mangaManager = new MangaManager();
    }
    public function show($id): string
    {
        if (empty($id)) {
            header('HTTP/1.1 400 Bad Request');
        } else {
            $manga = $this->mangaManager->selectOneById($id);

            return $this->twig->render('Manga/show.html.twig', [
                'manga' => $manga
            ]);
        }
    }

    public function fav(): void
    {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $mangaId = trim($_POST['manga_id']);
            $isFav = trim($_POST['is_fav'] == '1');
            $errors = [];
            if (!is_numeric($mangaId) || !isset($mangaId)) {
                $errors[] = "Le format de l'id nest pas valable";
            }
            else{
                $this->mangaManager->favorite($mangaId, 1, $isFav);
               header('Location:/manga/show?id=' . $mangaId);
           }
   
        }
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mangaId = trim($_POST['manga_id']);
            $errors = [];

            if (!is_numeric($mangaId) || !isset($mangaId)) {
                $errors[] = "Le format de l'id nest pas valable";
            }
            else {
                $this->mangaManager->delete((int) $mangaId);
                header('Location: /');
            }
        }
    }
}



