<?php
namespace Ericc70\Openarticles\Command;

use Ericc70\Openarticles\Command\ArticleCommandInterface;
use Ericc70\Openarticles\Command\ArticleIdentifierCommandInterface;

interface EditArticleCommandInterface extends ArticleCommandInterface, ArticleIdentifierCommandInterface
{

}