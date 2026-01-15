<?php
declare(strict_types=1);

class AntrianController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Daftar Antrian');
    }
}
