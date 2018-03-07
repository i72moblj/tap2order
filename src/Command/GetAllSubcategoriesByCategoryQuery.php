<?php

namespace App\Command;


/**
 * Class GetAllSubcategoriesByCategoryQuery
 * @package App\Command
 */
class GetAllSubcategoriesByCategoryQuery
{
    /**
     * @var int
     */
    private $categoryId;

    /**
     * GetAllSubcategoriesByCategoryQuery constructor.
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

