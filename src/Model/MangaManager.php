<?php
 
 namespace App\Model;

 class MangaManager extends AbstractManager
 {
    public const TABLE = "manga";
    public const TABLE_MANGA_USER = "manga_user";


    public function favorite(int $mangaId, int $userId, bool $isFav): int
    {
        $statement = $this->pdo->prepare("UPDATE ". self::TABLE_MANGA_USER. " SET is_fav = :is_fav WHERE manga_id = :manga_id AND user_id = :user_id");


        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE_MANGA_USER . " (`manga_id` , `user_id` , `is_fav`) VALUES (:manga_id , :user_id , :is_fav)");
        $statement->bindValue(':manga_id', $mangaId, \PDO::PARAM_INT);
        $statement->bindValue(':user_id', $userId, \PDO::PARAM_INT);
        $statement->bindValue(':is_fav', $isFav, \PDO::PARAM_BOOL);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }



 }
