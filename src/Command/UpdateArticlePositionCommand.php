<?php

namespace Ericc70\Openarticles\Command;


final class UpdateArticlePositionCommand
{

    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): UpdateArticlePositionCommand
    {
        $this->data = $data;
        return $this;
    }
}