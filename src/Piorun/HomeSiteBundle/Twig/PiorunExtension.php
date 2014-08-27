<?php

//src/Piorun/HomeSiteBundle/Twig/PiorunExtension.php

namespace Piorun\HomeSiteBundle\Twig;

class PiorunExtension extends \Twig_Extension {
    
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('piorun', array($this, 'strongFilter')),
        );
    }
    /*Funkcja odpowiedzialna za zamianę wybranie i zamianę ciągu znaków*/
    public function strongFilter($text) {

        $txt = preg_replace('/__.*?__/', '<strong>$0</strong>', $text);
        $txt = str_replace('__', '', $txt);

        return $txt;
    }

    public function getName() {
        return 'piorun_extension';
    }

}
