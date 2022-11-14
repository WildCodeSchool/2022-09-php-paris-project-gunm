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
        $mangasRands = $model->selectMangaRand();
        return $this->twig->render('Manga/showcase.html.twig', ['mangas' => $mangas,'mangasRands' => $mangasRands]);
    }

    public function showmangas(): string
    {
        $model = new MangaManager();
        $allMangas = $model->selectAllMangas();
        $timeMangas = [];
        foreach ($allMangas as $allManga ) {
            $timeMangas [] = strftime('%d-%m-%Y', strtotime($allManga['date_release'])) ;
        }
        return $this->twig->
        render('Manga/show_mangas.html.twig', ['allMangas' => $allMangas, 'timeMangas' => $timeMangas]);
    }
}
