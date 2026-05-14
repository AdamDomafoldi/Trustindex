<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ReviewRepository;


final class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review')]
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('review/index.html.twig', [
            'reviews' => $reviewRepository->findLatestReviews(),
        ]);
    }

    #[Route('/review/new', name: 'review_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $review = new Review();

        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($review);
            $entityManager->flush();

            $this->addFlash('success', 'Köszönjük a véleményed!');

            return $this->redirectToRoute('app_review');
        }

        return $this->render('review/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/review/{id}', name: 'review_view', requirements: ['id' => '\d+'])]
    public function view(Review $review): Response
    {
        return $this->render('review/view.html.twig', [
            'review' => $review,
        ]);
    }

    #[Route('/review/companies', name: 'companies')]
    public function companies(ReviewRepository $reviewRepository): Response
    {
        return $this->render('review/companies.html.twig', [
            'companies' => $reviewRepository->getCompanyStatistics(),
        ]);
    }
}
