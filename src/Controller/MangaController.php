<?php

namespace App\Controller;

use App\Model\MangaManager;

class MangaController extends AbstractController
{
    protected MangaManager $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new MangaManager();
    }

    public function showcase(): string
    {
        $model = new MangaManager();
        $mangas = $model->selectManga();
        return $this->twig->render('Manga/showcase.html.twig', ['mangas' => $mangas]);
    }
}