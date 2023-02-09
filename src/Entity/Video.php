<?php

namespace APP\Sk8play\Entity;

class Video 
{
    public readonly int $id;
    public readonly string $linkVideo;

    public function __construct(
        string $linkVideo,
        public readonly string $title
    )
    {
        $this->setUrl($linkVideo);
    }

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
}
