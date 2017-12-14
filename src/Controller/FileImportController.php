<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FileImportController extends Controller {

    /**
     * Route for importing file
     *
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('App Index');
    }
}