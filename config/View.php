<?php
namespace Config;
use Config\Filter;
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use Symfony\Component\Form\Forms;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Component\Form\FormRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Config\Core\tags\Project_Twig_Extension;

class View{
    public static function render($path, $content = []){

        // creates the Translator
        $translator = new Translator('en');
        // somehow load some translations into it
        // $translator->addLoader('xlf', new XliffFileLoader());
        // $translator->addResource(
        //     'xlf',
        //     __DIR__.'/vendor/symfony/translations/messages.en.xlf',
        //     'en'
        // );

        $csrfStorage = new NativeSessionTokenStorage();
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);
        $loader = realpath(__DIR__.'/../public');
        $defaultFormTheme = 'bootstrap_4_layout.html.twig';
        $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
        $vendorTwigBridgeDirectory = dirname($appVariableReflection->getFileName());

        
        $twig = new Environment(new FilesystemLoader([
            $loader,
            $vendorTwigBridgeDirectory.'/Resources/views/Form',
        ]));
        $formEngine = new TwigRendererEngine([$defaultFormTheme], $twig);
        $twig->addRuntimeLoader(new FactoryRuntimeLoader([
            FormRenderer::class => function () use ($formEngine, $csrfManager) {
                return new FormRenderer($formEngine, $csrfManager);
            },
        ]));
        $twig->addExtension(new TranslationExtension($translator));
        $twig->addExtension(new FormExtension());
        $twig->addExtension(new Filter());
//        $twig->addExtension(new Project_Twig_Extension());
        return $twig->render($path, $content);
    }

    public static function redirect($url){
        if (headers_sent()){
            die('<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">');
        }else{
            header('Location: ' . $url);
            die();
        }
    }

}