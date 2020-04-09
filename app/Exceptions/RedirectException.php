<?php
namespace App\Exceptions; 

Class RedirectException extends \Exception
{
    protected $response;

    public function getResponse() 
    {
        return $this->response;
    }

    public function setResponse($response) 
    {
        $this->response = $response;
        return $this;
    }

}