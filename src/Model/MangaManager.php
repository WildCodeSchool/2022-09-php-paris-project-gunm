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
        $statement = $this->pdo->query('SELECT title, image FROM manga LIMIT 3');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectMangaRand() : array
    {
        $statement = $this->pdo->query('SELECT title, image FROM manga ORDER BY RAND() LIMIT 3');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
