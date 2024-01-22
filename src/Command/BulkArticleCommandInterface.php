<?php
namespace Ericc70\Openarticles\Command;

interface BulkArticleCommandInterface {



    
    public function getArticleIds() :array;

    public function assertIsEmptyOrContainsNoIntegerValues(array $ids) :bool;
}