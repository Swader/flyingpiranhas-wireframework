<?php

    /** Modules have namespaces. This is to ensure uniqueness and easy sharing. */
    namespace home\controllers\abstracts;

    use flyingpiranhas\mvc\controller\abstracts\ControllerAbstract;
    use app\Settings;
    use flyingpiranhas\common\utils\Debug;

    /**
     * This is the Home abstract Controller.
     * We've put it here so that we can have one common title across all controllers in the Home module
     * without plugging it into the layout in a hardcoded fashion.
     *
     * Alternatively, you could just use settings to retrieve a saved title from the database!
     */
    abstract class HomeController extends ControllerAbstract
    {

        /** @var Settings */
        protected $oSettings;

        /**
         * The constructor of the controller denotes the app\Settings class as a
         * parameter it depends on. This class is registered as a shared resource in the
         * extended Bootstrapper
         *
         * @param \app\Settings $oSettings
         */
        public function __construct(Settings $oSettings)
        {
            $this->oSettings = $oSettings;
        }


        /**
         * Executed before any action
         */
        public function preDispatch()
        {

            /**
             * Suggestion for META, according to HTML5 boilerplate
             *
             * @see http://html5boilerplate.com/
             */

            /**
             *
             * You can hardcode all this into the layout, as it is by default, or you can incur a small
             * performance penalty but gain the ability to change all these layout parameters through a
             * UI since they're saved in the database. This saves your end users from having to touch code.
             *
            if ($this->oSettings->meta === null) {
            $this->oSettings->meta = array(
            'name'       => array(
            'keywords'    => 'My keywords',
            'description' => 'My description',
            'viewport'    => 'width=device-width'
            ),
            'property'   => array(
            'og:type' => 'website'
            ),
            'http-equiv' => array(
            'X-UA-Compatible' => 'IE=edge,chrome=1'
            )
            );
            $this->oSettings->saveSettings();
            }

            foreach ($this->oSettings->meta['name'] as $sName => $sContent) {
            $this->getHead()->appendMetaName($sName, $sContent);
            }
            foreach ($this->oSettings->meta['property'] as $sProperty => $sContent) {
            $this->getHead()->appendMetaProperty($sProperty, $sContent);
            }
            foreach ($this->oSettings->meta['http-equiv'] as $sProperty => $sContent) {
            $this->getHead()->appendMetaProperty($sProperty, $sContent);
            }
             */

            $this->getHead()
                ->setTitle($this->oSettings->title ? $this->oSettings->title : 'Some title')
                ->setMinifyDir('assets/minify');

            /**
             * These stylesheets and scripts will automatically get minified.
             * Only when a change is detected in one of the original files will they be re-minified, so
             * you can be sure this only happens once and loads the minified cached copy every time.
             */
            $this->getHead()
                ->appendStylesheet('/assets/css/bootstrap.min.css')
                ->appendStylesheet('/assets/css/bootstrap-responsive.min.css')
                ->appendStylesheet('/assets/css/main.css')
                ->appendScript('/assets/js/vendor/bootstrap.min.js')
                ->appendScript('/assets/js/plugins.js')
                ->appendScript('/assets/js/main.js');

        }
    }
