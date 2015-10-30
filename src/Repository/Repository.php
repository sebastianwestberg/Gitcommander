<?php

namespace Sebastianwestberg\Bts\Repository;

class Repository
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * @return array of list elements
     */
    public function getAll()
    {
        $this->session->visit('https://github.com');
        $page = $this->session->getPage();
        return $page->findAll('css', '#repo_listing li');
    }

    public function create($name, $desc, $visibility = null)
    {
        if ($visibility !== 'private') {
            $isHidden = 'true';
        } else {
            $isHidden = 'false';
        }

        $this->session->visit('https://github.com/new');
        $page = $this->session->getPage();
        $form = $page->find('css', '#new_repository');
        $form->fillField('repository_name', $name);
        $form->fillField('repository_description', $desc);
        $form->selectFieldOption('repository_public_false', true);
        $form->submit();
    } 
} 
