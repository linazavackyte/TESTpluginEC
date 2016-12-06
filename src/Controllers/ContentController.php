<?php
namespace HelloWorld\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use HelloWorld\Helpers;

/**
 * Class ContentController
 * @package HelloWorld\Controllers
 */
class ContentController extends Controller
{
	/**
	 * @param Twig $twig
	 * @return string
	 */
	public function sayHello(Twig $twig):string
	{
		$value = TestValue::getTestValue();
		$twig->addGlobal('testval', $value);
		return $twig->render('HelloWorld::content.hello');
	}
}
