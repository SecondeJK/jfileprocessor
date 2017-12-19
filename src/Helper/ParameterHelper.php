<?php
namespace App\Helper;

class ParameterHelper
{
    public $parameterBag;

    public function __construct(array $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getParameterBag()
    {
        return $this->parameterBag;
    }
}