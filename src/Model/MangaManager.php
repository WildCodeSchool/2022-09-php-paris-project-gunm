<?php

namespace App\Model;

use App\Model;

class MangaManager
{
    public function addManga(array $recipeManga): void
    {
        $connection->getConnection();

        $query = 'INSERT INTO manga (title, autor, description, image, date, category) 
        VALUES (:title, :autor, :description, :image, :date, :categorie)';
        $statment = $pdo->prepare($query);

        $statment->bindValue(':title', $recipeManga['title'], \PDO::PARAM_STR);
        $statment->bindValue(':autor', $recipeManga['autor'], \PDO::PARAM_STR);
        $statment->bindValue(':description', $recipeManga['description'], \PDO::PARAM_STR);
        $statment->bindValue(':image', $recipeManga['image'], \PDO::PARAM_STR);
        $statment->bindValue(':date', $recipeManga['date'], \PDO::PARAM_STR);
        $statment->bindValue(':categorie', $recipeManga['categorie'], \PDO::PARAM_STR);

        $statment->execute();
    }
}