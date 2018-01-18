<?php

namespace App\Command;


/**
 * Class GetAllProductsQuery
 * @package App\Command
 */
class GetAllProductsQuery
{
    /**
     * @var int
     */
    private $subcategoryId;


    /**
     * GetAllProductsQuery constructor.
     * @param int $subcategoryId
     */
    public function __construct(int $subcategoryId = 1)
    {
        $this->subcategoryId = $subcategoryId;
    }

    /**
     * @return int
     */
    public function getSubcategoryId(): int
    {
        return $this->subcategoryId;
    }
}