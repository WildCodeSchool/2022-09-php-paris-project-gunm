<?php

namespace App\Controller;

use App\Model\MangaManager;

class MangaController extends AbstractController
{
    private MangaManager $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new MangaManager();
    }

    public function showcase(): string
    {
        return $this->twig->
        render('Manga/showcase.html.twig', ['mangas' => $this->model->selectManga(),'mangasRands' => $this->model->selectMangaRand()]);
    }

    public function list(): string
    {
        return $this->twig->
        render('Manga/list.html.twig', ['mangas' => $this->model->selectAll()]);
    }
}
