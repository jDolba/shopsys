<?php

namespace Shopsys;


use Shopsys\FrameworkBundle\Component\Environment\EnvironmentInterface;

class Environment implements EnvironmentInterface {

    public function getRootDir() {
        return __DIR__ .'/../../../../../project-base';
    }


}