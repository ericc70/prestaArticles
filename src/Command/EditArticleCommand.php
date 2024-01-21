<?php
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\ValueObject\ArticleId;
use Ericc70\Openarticles\Command\AbstractArticleCommand;
use Ericc70\Openarticles\Command\EditArticleCommandInterface;

final class EditArticleCommand extends AbstractArticleCommand implements  EditArticleCommandInterface
{
    use AbstractArticleIdentifierCommand;
}
