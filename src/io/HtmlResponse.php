<?php
namespace JSomerstone\Feather\io;

use \Twig_Environment;

class HtmlResponse extends Response
{
    /**
     * @var string Name of the template for Twig_Environment to render
     */
    protected $template;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var string HTML-content of response
     */
    protected $htmlContent;

    /**
     * @param \Twig_Environment $twig
     * @param string $template
     */
    public function __construct(\Twig_Environment $twig, $template)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->setHeader('Content-type', 'text/html');
    }

    /**
     * Overrides rendered (to be rendered) content with given string
     * @param string $content
     */
    public function setContent($content)
    {
        $this->htmlContent = $content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->printHeaders();

        if ( ! $this->htmlContent)
        {
            $this->htmlContent = $this->twig->render($this->template, $this->content);
        }
        return $this->htmlContent;
    }

    public static function notFound()
    {
        http_response_code(404);
    }

    public static function serverError()
    {
        http_response_code(500);
    }

} 
