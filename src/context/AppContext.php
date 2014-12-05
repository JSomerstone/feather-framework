<?php
/**
 * Created by PhpStorm.
 * User: joona
 * Date: 04/12/14
 * Time: 22:33
 */

namespace JSomerstone\Feather\context;

use JSomerstone\Feather\io\Request;

class AppContext
{
    /**
     * @var AppContext
     */
    private static $instance;

    /**
     * @var \Twig_Environment
     */
    public $twig;

    /**
     * @var Request
     */
    public $request;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return AppContext
     */
    public static function getInstance()
    {
        if ( ! isset(self::$instance))
        {
            self::$instance = new AppContext();
        }
        return self::$instance;
    }

    /**
     * @param AppContext $context
     */
    public static function setInstance(AppContext $context)
    {
        self::$instance = $context;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        if ( ! $this->twig)
        {
            $this->twig = new \Twig_Environment(
                new \Twig_Loader_Filesystem(__DIR__ . '/../views/')
            );
        }
        return $this->twig;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        if ( ! $this->request)
        {
            $this->request = new Request($_GET, $_POST);
        }
        return $this->request;
    }
} 
