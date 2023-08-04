<?php

namespace App\Controller;

use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Elastica\Query\Fuzzy;

class BlogController extends AbstractController
{
    public function __construct(private PaginatedFinderInterface $blogFinder){}

    #[Route('/blog', name: 'blog')]
    public function blogAction(Request $request): Response
    {
        $results = $this->blogFinder->find(new Fuzzy("content", $request->get("q")));
        return $this->json($results);
    }
}