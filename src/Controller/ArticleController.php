<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Hey I love coding');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response('Future articles for '. $slug);
    }
}