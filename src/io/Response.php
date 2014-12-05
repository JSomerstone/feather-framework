<?php
/**
 * Created by PhpStorm.
 * User: joona
 * Date: 04/12/14
 * Time: 22:57
 */

namespace JSomerstone\Feather\io;

abstract class Response
{
    /**
     * @var array
     */
    protected $headers = array();

    /**
     * @var array
     */
    protected $content = array();

    public function set($key, $value)
    {
        $this->content[$key] = $value;
        return $this;
    }

    public function bind($key, &$value)
    {
        $this->content[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @param string|null $value
     */
    public function setHeader($key, $value = null)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Outputs all headers set via setHeader()
     */
    protected function printHeaders()
    {
        foreach ($this->headers as $header => $value)
        {
            if (is_null($value))
            {
                header("$header");
            } else {
                header("$header: $value");
            }
        }
    }
} 
