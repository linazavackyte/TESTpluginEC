<?php //strict

namespace EasyCredit\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use EasyCredit\Helper\OrderInformationHelper;

/**
 * Class OrderInformationController
 * @package EasyCredit\Controllers
 */
class OrderInformationController extends Controller
{
    
    /**
	 * @param Twig $twig
	 * @return string
	 */
    public function sayPersonData(Twig $twig):string
    {
        return $twig->render('EasyCredit::Order.OrderInformation');
    }

}
