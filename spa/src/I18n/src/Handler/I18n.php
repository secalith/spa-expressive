<?php
namespace I18n\Handler;

use	Zend\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Session\SessionMiddleware;

class I18n implements MiddlewareInterface
{
    private $router;
    private $template;
    private $containerName;
    private $translator;
    private $language;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        \Zend\I18n\Translator\TranslatorInterface $translator,
        $language = null
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->translator = $translator;
        $this->language = $language;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {

//        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
//
//        if ( null !== $session->get('i18n_current')) {
//            $session->set('i18n_current',$this->getUserLanguage());
//            $this->translator->setLocale($this->getUserLanguage());
//        }
        $this->translator->setLocale('en_en');
//        return	$handler->handle($request->withAttribute(self::class,	$this->translator->getLocale()));

        $this->translator->setLocale($this->language );



        return	$handler->handle($request->withAttribute(self::class,	$this->language));
    }
    function getUserLanguage() {
        $langs = array();

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            // break up string into pieces (languages and q factors)
            preg_match_all(
                '/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i',
                $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                $lang_parse
            );

            if (count($lang_parse[1])) {
                // create a list like 'en' => 0.8
                $langs = array_combine($lang_parse[1], $lang_parse[4]);

                // set default to 1 for any without q factor
                foreach ($langs as $lang => $val) {
                    if ($val === '') {
                        $langs[$lang] = 1;
                    }
                }
                // sort list based on value
                arsort($langs, SORT_NUMERIC);
            }
        }
        //extract most important (first)
        reset($langs);
        $lang = key($langs);

        //if complex language simplify it
        if (stristr($lang, '-')) {
            list($lang) = explode('-', $lang);
        }

        return $lang . "_" . $lang;
    }
}

