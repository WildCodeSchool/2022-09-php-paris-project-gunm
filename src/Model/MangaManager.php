<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

class MangaManager extends AbstractManager
{
    public const TABLE = "manga";

    public function selectMangaRand(): array
    {
        $statement = $this->pdo->query("SELECT title, image FROM " .  static::TABLE  . " JOIN manga_user ON manga_user.manga_id = manga.id " . " WHERE is_fav = 1 " . " ORDER BY RAND() LIMIT 3 ");        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllByCategory(string $category): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE category=:category");
        $statement->bindValue(':category', $category, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchall(PDO::FETCH_ASSOC);
    }
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
