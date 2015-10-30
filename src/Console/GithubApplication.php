<?php

namespace Sebastianwestberg\Bts\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Yaml\Parser;

class GithubApplication extends Application
{
    protected $settings;

    public function __construct()
    {
        parent::__construct();
        $yaml = new Parser();

        $this->settings = $yaml->parse(file_get_contents(__DIR__.'/../settings.yml'));
    }

    public function getSettings()
    {
        return $this->settings;
    }
}
