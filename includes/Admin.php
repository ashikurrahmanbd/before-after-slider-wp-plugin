<?php

namespace Pixelese\Bas;

class Admin{

    function __construct(){


        new Admin\Assets();

        new Admin\Menu();

        new Admin\Cpt();

    }

}