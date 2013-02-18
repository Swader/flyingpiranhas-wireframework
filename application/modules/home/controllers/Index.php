<?php

    /** Modules have namespaces. This is to ensure uniqueness and easy sharing. */
    namespace home\controllers;

    use home\controllers\abstracts\HomeController;
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
            $this->getView()->setLayout('default');
            $this->getHead()->setTitle($this->getHead()->getTitle().' - Hello!');
            $this->getView()->addViewData('message',
                'Looks like everything is running fine! This action is in the Index controller of
                the Home module, and forces the layout to be "default". If you go to
                <a href="/home/index/sticky">Sticky Action</a> you get to see the sticky-footer layout
                which is forced in the HomeController controller in the Home
                module under controllers/abstracts.'
            );
            return $this->getView();
        }

        /**
         * @return View
         */
        public function stickyAction() {
            $this->getHead()->appendTitle('Sticky Action!');
            $this->getView()->addViewData('message',
                'Looks like everything is running fine! This action is in the Index controller of
                the Home module. If you go to <a href="/">home/index/index</a> you get to see the default
                layout in use.'
            );
            return $this->getView();
        }

    }
