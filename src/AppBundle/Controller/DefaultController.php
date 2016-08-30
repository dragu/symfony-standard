<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\CommentType;
use AppBundle\Entity\Comment;

class DefaultController extends Controller
{
    /**
     * @Route("/csrf", name="csrf")
     */
    public function csrfAction()
    {
        $commentForm = $this->createForm(CommentType::class, new Comment());

        $commentForm->submit([
            'comment' => 'fuuuuuuuuu'
        ]);

        if (!$commentForm->isValid()) {
            return new Response($commentForm->getErrors(true)[0]->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/no-csrf", name="nocsrf")
     */
    public function noCsrfAction()
    {
        $commentForm = $this->createForm(CommentType::class, new Comment());

        $commentForm->submit([
            'comment' => 'test',
        ]);

        if (!$commentForm->isValid()) {
            return new Response($commentForm->getErrors(true)[0]->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response('OK');
    }
}
