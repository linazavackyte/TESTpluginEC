<?php

namespace EasyCredit\Migrations;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use EasyCredit\Helper\EasyCreditHelper;

/**
 * Migration to create payment mehtods
 *
 * Class CreatePaymentMethod
 * @package EasyCredit\Migrations
 */
class CreatePaymentMethod
{
    /**
     * @var PaymentMethodRepositoryContract
     */
    private $paymentMethodRepositoryContract;

    /**
     * @var PaymentHelper
     */
    private $paymentHelper;

    /**
     * CreatePaymentMethod constructor.
     *
     * @param PaymentMethodRepositoryContract $paymentMethodRepositoryContract
     * @param EasyCreditHelper $paymentHelper
     */
    public function __construct(    PaymentMethodRepositoryContract $paymentMethodRepositoryContract,
                                    EasyCreditHelper $paymentHelper)
    {
        $this->paymentMethodRepositoryContract = $paymentMethodRepositoryContract;
        $this->paymentHelper = $paymentHelper;
    }

    /**
     * Run on plugin build
     *
     * Create Method of Payment ID for EasyCredit if they don't exist
     */
    public function run()
    {
        // Check whether the ID of the EasyCredit payment method has been created
        if($this->paymentHelper->getPaymentMethod() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'plenty_easycredit',
                                        'paymentKey' => 'EASYCREDIT',
                                        'name' => 'EasyCredit');

            $this->paymentMethodRepositoryContract->createPaymentMethod($paymentMethodData);
        }

    }
}