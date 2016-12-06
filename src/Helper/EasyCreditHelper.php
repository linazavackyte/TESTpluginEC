<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
    use Plenty\Modules\Payment\Method\Models\PaymentMethod;

    /**
     * Class EasyCreditHelper
     *
     * @package EasyCredit\Helper
     */
    class EasyCreditHelper
    {
        /**
         * @var PaymentMethodRepositoryContract $paymentMethodRepository
         */
        private $paymentMethodRepository;

        /**
         * EasyCreditHelper constructor.
         *
         * @param PaymentMethodRepositoryContract $paymentMethodRepository
         */
        public function __construct(PaymentMethodRepositoryContract $paymentMethodRepository)
        {
            $this->paymentMethodRepository = $paymentMethodRepository;
        }

        /**
         * Create the ID of the payment method if it doesn't exist yet
         */
        public function createMopIfNotExists()
        {
            // Check whether the ID of the Pay upon pickup payment method has been created
            if($this->getPaymentMethod() == 'no_paymentmethod_found')
            {
                $paymentMethodData = array( 'pluginKey' => 'plenty_easycredit',
                                            'paymentKey' => 'EASYCREDIT',
                                            'name' => 'Pay with EasyCredit');

                $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
            }
        }

        /**
         * Load the ID of the payment method for the given plugin key
         * Return the ID for the payment method
         *
         * @return string|int
         */
        public function getPaymentMethod()
        {
            $paymentMethods = $this->paymentMethodRepository->allForPlugin('plenty_easycredit');

            if( !is_null($paymentMethods) )
            {
                foreach($paymentMethods as $paymentMethod)
                {
                    if($paymentMethod->paymentKey == 'EASYCREDIT')
                    {
                        return $paymentMethod->id;
                    }
                }
            }

            return 'no_paymentmethod_found';
        }
    }
