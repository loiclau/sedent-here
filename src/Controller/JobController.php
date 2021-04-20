<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/jobs", name="job.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'job/index.html.twig',
            ['current_menu' => 'job']
        );
    }


}