<?php
namespace JSomerstone\Feather\io;


class Request
{
    protected $uri;
    protected $post;
    protected $get;

    public function __construct($uri, array $get = array(), array $post = array())
    {
        $this->post = $post;
        $this->get = $get;
    }

    /**
     * @param string $name
     * @return null|mixed
     */
    public function getParameter($name)
    {
        if ( isset($this->post[$name]))
        {
            return $this->post[$name];
        } else if ( isset($this->get[$name]))
        {
            return $this->post[$name];
        }
        return null;
    }

    public function getOrFail($name)
    {
        $value = $this->getParameter($name);
        if ( null === $value)
        {
            throw new ParameterNotFoundException($name);
        }
    }

    public function has($name)
    {
        return (null !== $this->getParameter($name));
    }
} 

class RequestException extends \Exception{}
class ParameterNotFoundException extends RequestException{}
