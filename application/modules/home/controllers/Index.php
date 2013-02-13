<?php

    /** Modules have namespaces. This is to ensure uniqueness and easy sharing. */
    namespace home\controllers;

    use flyingpiranhas\mvc\controller\abstracts\ControllerAbstract;
    use home\controllers\abstracts\HomeController;
    use app\Settings;
    use flyingpiranhas\mvc\views\View;
    use flyingpiranhas\common\utils\Debug;

    /**
     * This is the Index Controller. It's a starting point to your application.
     */
    class Index extends HomeController
    {

        /**
         * All actions return a View object.
         * Every View object can be modified and extended. Look at its documentation for more info.
         *
         * @return View
         */
        public function indexAction()
        {
            $oView = new View;
            $oView->setLayout('default');
            $this->getHead()->setTitle($this->getHead()->getTitle().' - Hello!');
            return $oView;
        }

    }
