<?php

namespace App\Controller;


use App\Entity\Article;
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
     */
    public function show(Article $article, MarkdownHelper $markdownHelper, LoggerInterface $logger, SlackClient $slack, EntityManagerInterface $em)
    {
        if ($article->getSlug() == 'slack') {
            $slack->sendMessage('John Doe', 'A message from SLACK');
        }
        $comments = [
            'Cum bubo trabem, omnes calcariaes experientia barbatus, superbus competitiones.Aonidess prarere, tanquam magnum historia.',
            'Cur hilotae peregrinationes?Ecce.Sunt pulchritudinees convertam raptus, secundus valebates.Nunquam imitari axona.',
            'Eras velum in magnum aetheres!Sunt advenaes perdere albus, fatalis cottaes.'
        ];

//        $repository= $em->getRepository(Article::class);
//
//        /** @var Article $article */
//        $article = $repository->findOneBy(['slug' => $slug]);
//
//        if(!$article) {
//            throw $this->createNotFoundException(sprintf('No article for slug: "%s"', $slug));
//        }


        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     * VIPNOTE: using the shortcut here since we have the slug which is the same as property in the Article entty
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush(); // no need for persist for updates

        $logger->info('Article is being hearted');
        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}