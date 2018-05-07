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
        $article = new Article();
        $article->setTitle('Why Selfish People Are Selfish')
            ->setSlug('why-selfish-people-are-selfish' . mt_rand())
            ->setContent('One morning, when **Gregor Samsa woke from troubled dreams**, he found himself transformed in his bed into a horrible vermin. *He lay on his armour-like back, and if he lifted his head a little* 
            
            he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.
            
            His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me?" he thought. It wasn\'t a dream. His room, a 
            
            proper human room although a little too small, [lay peacefully between its four](http://localhost:8080/news/why-selfish-people-are-selfish107) familiar walls. A collection of textile samples lay spread out on the table - Samsa was a 
            
            travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a 
            
            fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. 
            
            Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do 
            
            because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        // publish most articles
        if(rand(1, 10) > 3) {
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(2, 100))));
        }

        $em->persist($article);
        $em->flush();

        return new Response(sprintf('Hiya! new article id: #%d slug: %s has been created', $article->getId(), $article->getSlug()));
    }
}