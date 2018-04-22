<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('articles/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
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

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug)
    {
        return new JsonResponse(['hearts' => rand(6, 99)]);
    }
}