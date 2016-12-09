<?php // strict

namespace EasyCredit\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

/**
 * Class EasyCreditRouteServiceProvider
 * @package EasyCredit\Providers
 */
class EasyCreditRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Get EasyCredit success and cancelation URLs
        $router->get('EasyCredit/checkoutSuccess', 'EasyCredit\Controllers\PaymentController@checkoutSuccess');
        $router->get('EasyCredit/checkoutCancel' , 'EasyCredit\Controllers\PaymentController@checkoutCancel' );
    }
}