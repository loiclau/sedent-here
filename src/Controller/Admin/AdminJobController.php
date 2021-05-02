<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Entity\Techno;
use App\Form\JobType;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminJobController extends AbstractController
{

    /**
     * @var JobRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(JobRepository $repository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.job.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $jobs = $this->repository->findAll();
        return $this->render('admin/job/index.html.twig', compact('jobs'));
    }

    /**
     * @Route("/admin/job/create", name="admin.job.create")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($job);
            $this->em->flush();
            $this->addFlash('success', 'Annonce Créée');
            return $this->redirectToRoute('admin.job.index');
        }

        return $this->render(
            'admin/job/create.html.twig',
            [
                'job' => $job,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/job/{id}", name="admin.job.edit", methods="GET|POST"))
     * @param Job $job
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Job $job, Request $request)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Annonce modifiée');
            return $this->redirectToRoute('admin.job.index');
        }

        return $this->render(
            'admin/job/edit.html.twig',
            [
                'job' => $job,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/job/{id}", name="admin.job.delete", methods="DELETE")
     * @param Job $job
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Job $job, Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if ($this->isCsrfTokenValid('delete'. $job->getId(), $request->get('_token'))){
            $this->em->remove($job);
            $this->em->flush();
            $this->addFlash('success', 'Annonce supprimée');
        }
        return $this->redirectToRoute('admin.job.index');
    }
}
