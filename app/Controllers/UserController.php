<?php

namespace App\Controllers;

use App\Controllers\Controller;

use Slim\Http\UploadedFile;

Class UserController extends Controller
{
    public function avatar($request, $response)
    {
        if($request->isGet()){
            return $this->container->view->render($response, 'avatar.twig');
        }
    }

    private function moveUploadedFile($directory, UploadedFile $UploadedFile)
    {
        $extension = pathinfo($UploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $UploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}