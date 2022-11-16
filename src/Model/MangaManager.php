<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

class MangaManager extends AbstractManager
{
    protected PDO $pdo;
    public const TABLE = 'manga';

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getconnection();
    }

    public function selectManga(): array
    {
        $statement = $this->pdo->query('SELECT title, image FROM ' .static::TABLE. ' LIMIT 3');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectMangaRand(): array
    {
        $statement = $this->pdo->query('SELECT title, image FROM ' .static::TABLE. ' ORDER BY RAND() LIMIT 3');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllMangas(): array
    {
        $statement = $this->pdo->query('SELECT * FROM ' .static::TABLE);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function selectCategoryMangas(): array
    // {
    //     $statement = $this->pdo->query('SELECT * FROM ' .static::TABLE. ' WHERE category LIKE %kodomo%');
    //     return $statement->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function selectOneCategoryByCategory(string $category): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE category=:category");
        $statement->bindValue(':category', $category, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
}
