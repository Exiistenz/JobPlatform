<?php

namespace Message\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationController extends Controller
{
    public function indexAction()
    {
        return $this->render('MessageBundle:Default:index.html.twig');
    }
}
