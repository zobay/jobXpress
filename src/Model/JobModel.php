<?php

namespace App\Model;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;

class JobModel
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
        return $this->entityManager->getRepository(Job::class)->findAll();
    }

    public function getJobByCategory($id)
    {
        return $this->entityManager->getRepository(Job::class)->getJobByCategory($id);
    }

}
