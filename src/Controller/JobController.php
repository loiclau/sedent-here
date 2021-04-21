<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{

    /**
     * @var JobRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(
        JobRepository $repository,
        EntityManagerInterface $em
    ){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/jobs", name="job.index")
     * @return Response
     */
    public function index(): Response
    {
        $job = $this->repository->findAllAvailable();
        return $this->render(
            'job/index.html.twig',
            ['current_menu' => 'job']
        );
    }

    /**
     * @Route("/jobs/{slug}-{id}", name="job.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Job $job
     * @param string $slug
     * @return Response
     */
    public function show(Job $job, string $slug): Response
    {
        if ($job->getSlug() !== $slug) {
            return $this->redirectToRoute('job.show',
                [
                    'id' => $job->getId(),
                    'slug' => $job->getSlug()
                ],
                301
            );
        }
        return $this->render(
            'job/show.html.twig',
            ['job' => $job , 'current_menu' => 'job']
        );
    }


}