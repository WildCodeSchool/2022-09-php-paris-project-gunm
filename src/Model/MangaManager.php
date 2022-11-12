<?php

namespace App\Model;

use App\Model;

class MangaManager extends AbstractManager
{
    public const TABLE = 'manga';
    public function addManga(array $manga)
    {

        $statment = $this->pdo->prepare('INSERT INTO manga (title, author, description, image, released_at, category) 
        VALUES (:title, :author, :description, :image, :released_at, :categorie)');

        $statment->bindValue(':title', $manga['title'], \PDO::PARAM_STR);
        $statment->bindValue(':autor', $manga['author'], \PDO::PARAM_STR);
        $statment->bindValue(':description', $manga['description'], \PDO::PARAM_STR);
        $statment->bindValue(':image', $manga['image'], \PDO::PARAM_STR);
        $statment->bindValue(':released_at', $manga['released_at'], \PDO::PARAM_STR);
        $statment->bindValue(':categorie', $manga['categorie'], \PDO::PARAM_STR);

        $statment->execute();
    }
}
