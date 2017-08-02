<?php

namespace OwnCloud\SiteMapBuilder;

/**
 * Class RestructuredTextFilterIterator
 * @package OwnCloud\SiteMapBuilder
 */
class RestructuredTextFilterIterator extends \FilterIterator
{
    /**
     * @var string
     */
    private $fileFilter;

    /**
     * RestructuredTextFilterIterator constructor.
     * @param \Iterator $iterator
     * @param $filter
     */
    public function __construct(\Iterator $iterator, $filter)
    {
        parent::__construct($iterator);
        $this->fileFilter = $filter;
    }

    /**
     * @return bool
     */
    public function accept()
    {
        $file = $this->getInnerIterator()->current();
        return (pathinfo($file, PATHINFO_EXTENSION) === $this->fileFilter);
    }
}
