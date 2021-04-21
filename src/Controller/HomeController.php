<?php
namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     *
     * @Route("/", name="home")
     * @param JobRepository $repository
     * @return Response
     */
    public function index(JobRepository $repository): Response
    {
        $jobs = $repository->findLatest();
        return $this->render(
            'pages/home.html.twig',
            ['jobs' => $jobs]
        );
    }
}

