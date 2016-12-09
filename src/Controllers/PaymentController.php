<?php //strict

namespace EasyCredit\Controllers;

use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Response;

/**
 * Class PaymentController
 * @package EasyCredit\Controllers
 */
class PaymentController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var ConfigRepository
     */
    private $config;
    
    /**
     * PaymentController constructor.
     *
     * @param Response $response
     * @param ConfigRepository $config
     */
    public function __construct(  Response $response,
                                  ConfigRepository $config)
    {
        $this->response = $response;
        $this->config   = $config;
    }

    /**
     * EasyCredit redirects to this page if the payment could not be executed or other problems occurred
     */
    public function checkoutCancel()
    {
        // Redirects to the cancellation page. The URL can be entered in the config.json.
        return $this->response->redirectTo($this->config->get('EasyCredit.cancelUrl'));
    }

    /**
     * EasyCredit redirects to this page if the payment was executed correctly
     */
    public function checkoutSuccess()
    {
        return $this->response->redirectTo($this->config->get('EasyCredit.successUrl'));
    }

}
