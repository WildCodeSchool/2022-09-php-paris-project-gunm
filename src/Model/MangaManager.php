<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

class MangaManager extends AbstractManager
{
    protected PDO $pdo;

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getconnection();
    }

    public function selectManga(): array
    {
        $statement = $this->pdo->query('SELECT title, image FROM manga');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
