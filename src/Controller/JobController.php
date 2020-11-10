<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Model\CategoryModel;
use App\Model\JobModel;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{

    /**
     * @Route("/", name="job_index")
     *
     * @param JobModel $jobModel
     * @param CategoryModel $categoryModel
     *
     * @return Response
     */
    public function index(JobModel $jobModel, CategoryModel $categoryModel)
    {
        $allCategory = $categoryModel->getAllCategory();
        $allJob = $jobModel->getAllCategory();

        return $this->render('job/index.html.twig',[
            'categories' => $allCategory,
            'jobs' => $allJob
        ]);
    }

    /**
     * @Route("/category/{id}",name="job_by_category")
     * @param Request $request
     * @param Category $category
     * @param JobModel $jobModel
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function getJobByCategory(
        Request $request,
        Category $category,
        JobModel $jobModel,
        PaginatorInterface $paginator
    )
    {
        $jobs = $jobModel->getJobByCategory($category);
        $paginatedData = $paginator->paginate($jobs,
            $request->query->getInt('page', 1), 1);
        return $this->render('job/category.html.twig',[
            'jobs' => $paginatedData,
            'category' => $category
        ]);
    }

    /**
     * @Route("/search", name="search")
     *
     * @param Request $request
     * @param JobModel $jobModel
     * @param CategoryModel $categoryModel
     *
     * @return Response
     */
    public function search(
        Request $request,
        JobModel $jobModel,
        CategoryModel $categoryModel
    )
    {
        $data = $request->request->get('search');
        $jobs = $jobModel->getSearchedJob($data);
        $category = $categoryModel->getAllCategory();

        return $this->render('job/index.html.twig',[
            'categories' => $category,
            'jobs' => $jobs
        ]);
    }

    /**
     * @Route("/show/{id}", name="job_show")
     *
     * @param Job $job
     *
     * @return Response
     */
    public function show(Job $job)
    {
        return $this->render('job/detail.html.twig',[
            'job' => $job
        ]);
    }
}
