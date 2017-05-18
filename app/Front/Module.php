<?php
namespace Phasty\Front;

use Phalcon\Cart\Cart;
use Phalcon\Cart\Identifier\Cookie;
use Phalcon\Cart\Storage\Session;
use Phalcon\Iwi\Iwi;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Widgets\WidgetFactory;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;

class Module implements ModuleDefinitionInterface {

	public function registerAutoloaders(\Phalcon\DiInterface $di = null) {
		$loader = new Loader();
		$loader->registerNamespaces(array(
		));

		$loader->register();
	}

	public function registerServices(\Phalcon\DiInterface $di = null) {
		/**
		 * Setting up the view component
		 */

		/*$di->set('view', function () {
			$view = new View();
			$view->setViewsDir(__DIR__ . '/views/');
			$view->setTemplateAfter('main');
			return $view;
		}
		);
        */
        $di->setShared('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/'.view_type.'/');

            $view->registerEngines([
                '.volt' => function ($view) {
                    $config = $this->getConfig();

                    $volt = new VoltEngine($view, $this);

                    $volt->setOptions([
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ]);

                    return $volt;
                },
                '.phtml' => PhpEngine::class

            ]);
            $view->setTemplateAfter('main');
            return $view;
        });

		/**
		 * Images resize and cache
		 */
		$di->setShared('iwi', function () {
			return new Iwi();
		});

		/**
		 * cart
		 */
		$di->setShared('cart', function () {
			return new Cart(new Session(), new Cookie());
		});

		/**
		 * views widgets, $namespace were app widgets is located
		 */
		$di->setShared('widgets', function () {
			return new WidgetFactory($namespace = '\Phasty\Common\Service\Widgets');
		});
	}
}
