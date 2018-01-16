<?php

namespace App\Command;


/**
 * Class GetAllSubcategoriesQuery
 * @package App\Command
 */
class GetAllSubcategoriesQuery
{
    /**
     * @var int
     */
    private $categoryId;


    /**
     * GetAllSubcategoriesQuery constructor.
     * @param int $categoryId
     */
    public function __construct(int $categoryId = 1)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}

