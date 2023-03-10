<?php

namespace APP\Sk8play\Entity;

class Video 
{
    public readonly int $id;
    public readonly string $linkVideo;
    private ?string $filePath = null;

    public function __construct(
        string $linkVideo,
        public readonly string $title
    )
    {
        $this->setUrl($linkVideo);
    }

    //funcao para tratar/setar a url
    private function setUrl(string $linkVideo): void
    {
        if (filter_var($linkVideo, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException();
        }

        $this->linkVideo = $linkVideo;
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function setFilePathh(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}
