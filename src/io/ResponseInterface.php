<?php
/**
 * Created by PhpStorm.
 * User: joona
 * Date: 05/12/14
 * Time: 09:52
 */

namespace JSomerstone\Feather\io;


interface ResponseInterface
{
    /**
     * @param string $key
     * @param mixed $value
     * @return ResponseInterface
     */
    public function set($key, $value);

    /**
     * @param string $key
     * @param mixed $value as _reference_
     * @return ResponseInterface
     */
    public function bind($key, &$value);

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Renders the response - should output the headers
     * @return string
     */
    public function __toString();
} 
