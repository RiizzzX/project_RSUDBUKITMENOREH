<?php
declare(strict_types=1);

class LaporanController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Laporan');
    }
}
