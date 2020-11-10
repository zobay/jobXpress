<?php


namespace App\Model;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryModel
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllCategory()
    {
        return $this->entityManager
            ->getRepository(Category::class)
            ->findAll();
    }
}