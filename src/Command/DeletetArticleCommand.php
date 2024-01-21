<?php
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;
use Ericc70\Openarticles\Command\AbstractArticleCommand;
use Ericc70\Openarticles\Command\DeleteArticleCommandInterface;

final class DeletetArticleCommand implements  DeleteArticleCommandInterface
{
   use AbstractArticleIdentifierCommand;

}
