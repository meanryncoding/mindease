<?php

declare(strict_types=1);

namespace ReCrud\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    /**
     * Initialization hook method.
     */
    public function initialize(): void
    {
        parent::initialize();

        // Set the layout for the plugin
        $this->viewBuilder()->setLayout('ReCrud.default');

        // Load Flash component if not already loaded
        if (!$this->components()->has('Flash')) {
            $this->loadComponent('Flash');
        }
    }
}
