<?php

namespace Sebastianwestberg\Bts\Command;

use Symfony\Component\Console\Command\Command;
use Sebastianwestberg\Bts\Auth\Auth;
use Symfony\Component\Yaml\Yaml;

class AuthCommand extends command
{
    public function auth($username = null, $password = null)
    {
        if (!$this->isValid([$username, $password])) {
            $yaml = Yaml::parse(file_get_contents(__DIR__.'/../settings.yml'));
            $username = @$yaml['github']['username'];
            $password = @$yaml['github']['password'];

            if (!$this->isValid([$username, $password])) {
                throw new \Exception('No valid login details provided.');
            }
        }

        return Auth::login($username, $password);
    }

    protected function isValid($settings = [])
    {
        foreach ($settings as $setting) {
            if (empty($setting)) {
                return false; 
            }
        }

        return true;
    }
}
