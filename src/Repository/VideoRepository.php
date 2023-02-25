<?php

namespace APP\Sk8play\Repository;

use APP\Sk8play\Entity\Video;
use PDO;

class VideoRepository
{
    //PDO - injeção de dependência
    public function __construct(private PDO $pdo)
    {
    }

    //metodo para adicionar um video
    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (linkVideo, title, image_path) VALUES (?, ?, ?)';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $video->linkVideo);
        $stm->bindValue(2, $video->title);
        $stm->bindValue(3, $video->getFilePath());

        $resultado = $stm->execute();

        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));

        return $resultado;
    }

    //metodo para remove um video
    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(1, $id);
        return $stm->execute();
    }

    //metodo para atualiza um video
    public function update(Video $video): bool
    {
        $updateImageSql = '';
        if ($video->getFilePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE videos SET linkVideo = :linkVideo, title = :title $updateImageSql WHERE id = :id;";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':linkVideo', $video->linkVideo);
        $stm->bindValue(':title', $video->title);
        $stm->bindValue(':id', $video->id, PDO::PARAM_INT);

        if ($video->getFilePath() !== null) {
            $stm->bindValue(':image_path', $video->getFilePath());
        }
        
        return $stm->execute();
    }

    //metodo para listar todos os videos
    public function all(): array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    //encontrar um video por id
    public function find(int $id): Video
    {
        $stm = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

        return $this->hydrateVideo($stm->fetch(PDO::FETCH_ASSOC));
    }

    //hidratar os dados
    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['linkVideo'], $videoData['title']);
        $video->setId($videoData['id']);

        if ($videoData['image_path'] !== null) {
            $video->setFilePathh($videoData['image_path']);
        }

        return $video;
    }
}
