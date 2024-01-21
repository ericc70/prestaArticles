<?php
declare(strict_types=1);
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\Command\ArticleIdentifierCommandInterface;
use Ericc70\Openarticles\ValueObject\ArticleId;

trait AbstractArticleIdentifierCommand 
{

/**
     *
     * @var ArticleId
     */
    private $articleId;


    public function __construct(ArticleId $articleId)
    {
            $this->articleId = $articleId;
    }
    
    public function getArticleId() :ArticleId
    {
        return $this->articleId;
    }

}

