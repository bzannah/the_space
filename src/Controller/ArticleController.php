<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\CommentRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @var
     * VIPNOTE: not currently use, seeing autowiring works with construct of controllers
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Article::class);
        $articles = $repo->findAllPublishedOrderedByNewest();

        return $this->render('articles/homepage.html.twig',
        [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * VIPNOTE: using the shortcut here since we have the slug which is the same as property in the Article entity
     * VIPNOTE: lazy loading: related data is not queried for until, and unless, we use it.
     * @throws \Http\Client\Exception
     */
    public function show(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() == 'slack') {
            $slack->sendMessage('John Doe', 'A message from SLACK');
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     * VIPNOTE: using the shortcut here since we have the slug which is the same as property in the Article entity
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush(); // no need for persist for updates

        $logger->info('Article is being hearted');
        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}