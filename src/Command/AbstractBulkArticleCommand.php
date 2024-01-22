<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;
use Ericc70\Openarticles\Command\BulkArticleCommandInterface;
use Ericc70\Openarticles\Exception\InvalidBulkArticleExeption;

abstract class AbstractBulkArticleCommand implements BulkArticleCommandInterface
{

    /**
     * Undocumented variable
     *
     * @var ArticleId[]
     */
    private $articleId;

    public function __construct(array $articleId)
    {
     
        
        if ($this->assertIsEmptyOrContainsNoIntegerValues($articleId)) {

            throw new InvalidBulkArticleExeption('Un ou plusieur identifiant d\'article sont invalid');
        }

        $this->setArticleIds($articleId);
    }



    public function getArticleIds(): array
    {
        return $this->articleId;
    }
    public function setArticleIds(array $articleIds)
    {
        foreach ($articleIds as $id) {
            $this->articleId[] = new ArticleId($id);
        }
        return $this;
    }

    public function assertIsEmptyOrContainsNoIntegerValues(array $ids): bool
    {
        return empty(($ids) || $ids !== array_filter($ids, 'is_int'));
    }
}
