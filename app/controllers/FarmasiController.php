<?php
declare(strict_types=1);

class FarmasiController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Manajemen Farmasi');
        // Debug: test if view is properly set
        if (!isset($this->view) || !$this->view) {
            echo "ERROR: View not set in controller";
            return;
        }
    }
}
