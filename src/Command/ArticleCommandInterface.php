<?php

namespace Ericc70\Openarticles\Command;


interface ArticleCommandInterface{

    public function getProductId() :int;
    public function getPosition() :int;
    public function isActive() :bool;
    public function getTitle() :array;
    public function getResume() :array;
    public function getDescription() :array;


    public function setProductId(int $productId) :ArticleCommandInterface;
    public function setPosition(int $position) :ArticleCommandInterface;
    public function setActive(bool $active) :ArticleCommandInterface;
    public function setTitle(array $title) :ArticleCommandInterface;
    public function setResume(array $resume) :ArticleCommandInterface;
    public function setDescription(array $description) :ArticleCommandInterface;
}

//     public function setProductId(int $productId) :ArticleCommandInterface;
//     public function setPosition(int $position) :ArticleCommandInterface;
//     public function setActive(bool $active) :ArticleCommandInterface;
//     public function setTitle(array $title) :ArticleCommandInterface;
//     public function setResume(array $resume) :ArticleCommandInterface;
//     public function setDescription(array $description) :ArticleCommandInterface;
// }

