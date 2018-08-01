<?php
namespace i18n\Handler;

use	Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Session\SessionManager;

class I18nFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $translator = $container->get(\Zend\I18n\Translator\TranslatorInterface::class);
//        $translator->setLocale('fr_FR');
//        $translator->setLocale('pl_pl');
//        echo $translator->getLocale();die;
//          die();

       echo $language = 'en_en';die();

        return new I18n(
            $router,
            $template,
            get_class($container),
            $translator,
            $language
        );
    }
}
