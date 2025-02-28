<?php

namespace Pixelese\Beas;

class Admin{

    function __construct(){


        new Admin\Assets();

        new Admin\Menu();

        new Admin\Cpt();

    }

}