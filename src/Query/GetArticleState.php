<?php
namespace Ericc70\Openarticles\Query;

use Ericc70\Openarticles\ValueObject\ArticleId;

class GetArticleState
{
    /**
     * Undocumented variable
     *
     * @var ArticleId
     */
    private $articleId;


    public function __construct(int $articleId  )
    {
        $this->articleId = new ArticleId($articleId);
    }


    public function getArticleId() :ArticleId
    {
        return $this->articleId;
    }
}