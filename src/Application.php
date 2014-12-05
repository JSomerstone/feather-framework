<?php
/**
 * Created by PhpStorm.
 * User: joona
 * Date: 04/12/14
 * Time: 23:17
 */

namespace JSomerstone\Feather;


use JSomerstone\Feather\context\AppContext,
    JSomerstone\Feather\io\Response,
    JSomerstone\Feather\io\RequestException,
    JSomerstone\Feather\io\ParameterNotFoundException;

class Application
{
    public function run()
    {
        try
        {
            $uri = $_SERVER['REQUEST_URI'];
            $routes = $this->getRoutes();
            if ( ! isset($routes->$uri))
            {
                return Response::notFound();
            } else {
                return $this->runController($routes->$uri->controller, $routes->$uri->action);
            }
        }
        catch (ParameterNotFoundException $e)
        {
            die($e->getMessage());
        }
        catch (\Exception $e)
        {
            die($e->getMessage());
        }
    }

    private function runController ($controller, $action)
    {
        $controllerClass = sprintf(
            'JSomerstone\Feather\Controller\%s',
            $controller
        );

        $controller = new $controllerClass(
            AppContext::getInstance()
        );

        $controller->preAction();
        $output = $controller->$action(AppContext::getInstance()->getRequest());
        $controller->postAction();

        echo $output;
    }

    private function getRoutes()
    {
        return json_decode(file_get_contents(__DIR__ . '/routing.json'));
    }
} 
