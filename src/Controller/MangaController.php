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
        
        $mangasRands = $this->model->selectMangaRand();
        return $this->twig->render('Manga/showcase.html.twig', ['mangas' => $this->model->selectAll(),'mangasRands' => $mangasRands]);
    }

    public function list(): string
    { 
        // $timeMangas[] = strftime('%d-%m-%Y', strtotime($allManga['date_release']));
        return $this->twig->
        render('Manga/list.html.twig', ['mangas' => $this->model->selectAll()]);
    }
}
