<?php

namespace Message\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
    public function indexAction()
    {
        return $this->render('MessageBundle:Default:index.html.twig');
    }
}
