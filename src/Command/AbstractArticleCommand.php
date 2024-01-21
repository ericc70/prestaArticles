<?php

namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\Command\ArticleCommandInterface;

abstract  class AbstractArticleCommand implements ArticleCommandInterface
{

    /**
     * @var int
     */
    private $productId;

    /**
     * @var int
     */
    private $position = 1;
    /**
     * @var bool
     */
    private $active;
    /**
     * @var string[]
     */
    private $title;
    /**
     * @var string[]
     */
    private $resume;
    /**
     * @var string[]
     */
    private $description;



    /**
     * Get the value of productId
     *
     * @return  int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @param  int  $productId
     *
     * @return  self
     */
    public function setProductId(int $productId): ArticleCommandInterface
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of position
     *
     * @return  int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @param  int  $position
     *
     * @return  self
     */
    public function setPosition(int $position): ArticleCommandInterface
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of active
     *
     * @return  bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param  bool  $active
     *
     * @return  self
     */
    public function setActive(bool $active): ArticleCommandInterface
    {

        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string[]
     */
    public function getTitle(): array
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string[]  $title
     *
     * @return  self
     */
    public function setTitle(array $title): ArticleCommandInterface
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of resume
     *
     * @return  string[]
     */
    public function getResume(): array
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @param  string[]  $resume
     *
     * @return  self
     */
    public function setResume(array $resume): ArticleCommandInterface
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string[]
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string[]  $description
     *
     * @return  self
     */
    public function setDescription(array $description): ArticleCommandInterface
    {
        $this->description = $description;

        return $this;
    }
}
