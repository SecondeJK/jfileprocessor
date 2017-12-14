<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FileImportController extends Controller {

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpHandler;

    /**
     * Basic route
     *
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('App Index');
    }

    /**
     *
     */
    public function setGuzzle()
    {
        $this->httpHandler = $this->get('guzzle.client');
    }

    /**
     * Import route
     *
     * Expects incoming xml file delivered via curl
     * {example}
     * curl -i -X POST "localhost:8000/import" -H "Content-Type: text/xml" --data-binary xfilename.xml --header "Expect:"
     *
     * @Route("/import", name="import_file_route")
     *
     * @return Response
     */
    public function import(Request $request)
    {
        $this->setGuzzle();
        $xmlContent = $request->getContent();
        $xmlFile = simplexml_load_string($xmlContent);

        if (!$xmlFile) {
            // Throw exception for now, write handler to return 500 guzzle response @TODO
            throw new Exception('Warning: Not XML file');
        }

        $now = new \DateTime();
        $fileName = '/' . $now->getTimestamp() . '.xml';
        $projectDir = $this->get('kernel')->getProjectDir();
        $projectDir .= '/tmp/fileQueue';
        $fullPath = $projectDir .= $fileName;
        $importedFile = fopen($fullPath, "w");

        try {
            fwrite($importedFile, $xmlFile);
        } catch (Exception $e) {
            throw new Exception('Warning: could not write file');
        }

        return new Response('Import file router');
    }
}