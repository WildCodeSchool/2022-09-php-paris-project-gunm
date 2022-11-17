<?php

namespace App\Model;

use App\Model;

class MangaManager extends AbstractManager
{
    public const TABLE = 'manga';
    public function add(array $manga)
    {

        $statment = $this->pdo->prepare('INSERT INTO manga (title, author, description, image, released_at, category) 
        VALUES (:title, :author, :description, :image, :released_at, :category)');

        $statment->bindValue(':title', $manga['title'], \PDO::PARAM_STR);
        $statment->bindValue(':author', $manga['author'], \PDO::PARAM_STR);
        $statment->bindValue(':description', $manga['description'], \PDO::PARAM_STR);
        $statment->bindValue(':image', $manga['image'], \PDO::PARAM_STR);
        $statment->bindValue(':released_at', $manga['released_at'], \PDO::PARAM_STR);
        $statment->bindValue(':category', $manga['category'], \PDO::PARAM_STR);

        $statment->execute();
    }
}
