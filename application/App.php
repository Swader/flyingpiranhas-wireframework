<?php

use flyingpiranhas\mvc\App as MainApp;
use flyingpiranhas\common\dependencyInjection\interfaces\DIContainerInterface;
use flyingpiranhas\mvc\exceptions\MvcException;
use flyingpiranhas\mvc\router\interfaces\AppRouterInterface;
use flyingpiranhas\mvc\interfaces\ModuleBootstrapperInterface;
use flyingpiranhas\mvc\interfaces\ModuleInterface;

/**
 * @category       mvc
 * @package        flyingpiranhas.mvc
 * @license        Apache-2.0
 * @version        0.01
 * @since          2012-09-07
 * @author         Ivan Pintar
 */
class App extends MainApp
{

    /**
     * Everything in this method is executed before the action, before the controller preDispatch and before the
     * module preDispatch.
     */
    protected function preDispatch()
    {

    }

    /**
     * Everything in this method is executed after the module postDispatch, after the controller postDispatch and
     * after the action has been executed.
     */
    protected function postDispatch()
    {

    }

}
