<?php

namespace APP\Sk8play\Repository;

use APP\Sk8play\Entity\Video;
use PDO;

class VideoRepository 
{
    public function __construct(private PDO $pdo)
    {
    }

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (linkVideo, title) VALUES (?, ?)';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $video->linkVideo);
        $stm->bindValue(2, $video->title);

        $resultado = $stm->execute();

        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));

        return $resultado;
    }


    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $id);
        return $stm->execute();
    }

    public function update(Video $video): bool
    {
        $sql = 'UPDATE videos SET linkVideo = :linkVideo, title = :title WHERE id = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':linkVideo', $video->linkVideo);
        $stm->bindValue(':title', $video->title);
        $stm->bindValue(':id', $video->id, PDO::PARAM_INT);
        return $stm->execute();
    }
    
    /**
     * @return Video[]
     */
    public function all(): array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),            
            $videoList
        ); 
    }


    public function find(int $id): Video
    {
        $stm = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

        return $this->hydrateVideo($stm->fetch(PDO::FETCH_ASSOC));
    }

    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['linkVideo'], $videoData['title']);
        $video->setId($videoData['id']);

        return $video;
    }

    
}