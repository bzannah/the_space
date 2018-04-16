<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
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
        $comments = [
            'Cum bubo trabem, omnes calcariaes experientia barbatus, superbus competitiones.Aonidess prarere, tanquam magnum historia.',
            'Cur hilotae peregrinationes?Ecce.Sunt pulchritudinees convertam raptus, secundus valebates.Nunquam imitari axona.',
            'Eras velum in magnum aetheres!Sunt advenaes perdere albus, fatalis cottaes.'
        ];
        return $this->render('articles/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'slug' => $slug,
        ]);
    }
}