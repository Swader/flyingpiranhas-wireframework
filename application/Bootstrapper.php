<?php
    use flyingpiranhas\common\dependencyInjection\DIContainer;
    use flyingpiranhas\common\cache\ApcCache;
    use flyingpiranhas\common\utils\Debug;
    use flyingpiranhas\common\config\ConfigRoot;
    use app\Settings;

    /**
     * The bootstrapper registers the dependencies that the mvc uses.
     * See the parent class for how this is done, or look at the docs.
     *
     * @category       mvc
     * @package        flyingpiranhas.mvc
     * @license        Apache-2.0
     * @version        0.01
     * @since          2012-09-07
     * @author         Ivan Pintar
     */
    class Bootstrapper extends flyingpiranhas\mvc\Bootstrapper
    {

        /**
         * Here we override the initApp method, in order to register our own, extended App class as
         * the main App class of the application. This allows us to plug preDispatch and postDispatch
         * methods into the extended App class, which get executed before and after the application flow
         * has been executed, respectively.
         */
        protected function initApp()
        {
            $this->oDIContainer->registerClass(
                'App',
                'flyingpiranhas\\mvc\\interfaces\\AppInterface',
                DIContainer::SHARED_INSTANCE
            );
        }

        /**
         * Register custom dependencies here.
         * As a demo, we register a general app model for site settings.
         */
        protected function runCustomInit()
        {
            $this
                ->register_siteSettings()
                ->register_cache();
        }

        /**
         * This method registers a Settings model for us, which can be used (but doesn't have to be) to save
         * and retrieve some site values like title, meta, GA- code etc. This allows you to edit these parameters
         * via a web interface as opposed to hard coding them into the layout, at the cost of an extra database
         * query.
         *
         * @return Bootstrapper
         */
        private function register_siteSettings()
        {
            $oConfiguration = new ConfigRoot($this->sAppEnv, getcwd() . '/../application/config/Config.ini');
            //Debug::vddp($oConfiguration->toArray()['db']['mysql']);
            $oSettingsDb = new Settings($oConfiguration->toArray()['db']['mysql']);
            $oSettingsDb->loadSettings();
            $this->oDIContainer->registerInstance(
                $oSettingsDb,
                'app\\Settings'
            );
            return $this;
        }

        /**
         * Registers the Cache class to be used.
         * The Cache is a dependency inside the siteSettings model, and is automatically resolved when needed
         *
         * @return Bootstrapper
         */
        private function register_cache()
        {
            $this->oDIContainer->registerInstance(
                new ApcCache(),
                'app\\Cache'
            );
            return $this;
        }

    }
