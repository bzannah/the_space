<?php


namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleAdminController
 * @package App\Controller
 * @Route("/admin")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/new")
     */
    public function new(EntityManagerInterface $em)
    {
        die('todo');
        return new Response(sprintf('Hiya! new article id: #%d slug: %s has been created', $article->getId(), $article->getSlug()));
    }
}