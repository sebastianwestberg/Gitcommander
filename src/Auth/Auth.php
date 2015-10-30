<?php

namespace Sebastianwestberg\Bts\Auth;

use Behat\Mink\Session;
use Behat\Mink\Driver\GoutteDriver;
use Symfony\Component\Yaml\Dumper;

class Auth
{
    /**
     * @return $session 
     */
    public static function login($username, $password)
    {
        $driver = new GoutteDriver();

        $session = new Session($driver);
        $session->start();
        $session->visit('https://github.com/login');
    
        $page = $session->getPage();
        $form = $page->find('css', '.auth-form form');

        if (null === $form) {
            throw new \Exception('Couldn\'t locate the login form.');
        }

        $form->fillField('login_field', $username);
        $form->fillField('password', $password);
        $form->submit();

        // @todo need to check if successfully logged in here...

        $dumper = new Dumper();

        file_put_contents(__DIR__.'/../settings.yml', 
            $dumper->dump([
                'github' => [
                    'username' => $username,
                    'password' => $password,
                ]
            ], 2)
        );

        return $session;
    }
}

