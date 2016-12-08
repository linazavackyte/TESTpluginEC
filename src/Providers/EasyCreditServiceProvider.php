<?php //strict

    namespace EasyCredit\Providers;

    use Plenty\Modules\Payment\Events\Checkout\ExecutePayment;
    use Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;
    use Plenty\Plugin\ServiceProvider;
    use EasyCredit\Helper\EasyCreditHelper;
    use EasyCredit\Helper\BasketHelper;
    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
    use Plenty\Plugin\Events\Dispatcher;

    use EasyCredit\Methods\EasyCreditPaymentMethod;
    
    use EasyCredit\Services\EasyCreditPaymentService;

    use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
    use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemAdd;
    use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;

    /**
     * Class EasyCreditServiceProvider
     * @package EasyCreditProviders
     */
    class EasyCreditServiceProvider extends ServiceProvider
    {
        public function register()
        {

        }

        /**
         * Boot additional services for the payment method
         *
         * @param EasyCreditHelper $paymentHelper
         * @param PaymentMethodContainer $payContainer
         * @param Dispatcher $eventDispatcher
         **/
        public function boot( BasketHelper $basketHelper,
                              EasyCreditHelper $paymentHelper,
                              PaymentMethodContainer $payContainer,
                              Dispatcher $eventDispatcher,
                              EasyCreditPaymentService $easyCreditPaymentService)
        {
            // Register the Pay upon pickup payment method in the payment method container
            $payContainer->register('plenty_easycredit::EASYCREDIT', EasyCreditPaymentMethod::class,
                          [ AfterBasketChanged::class, AfterBasketItemAdd::class, AfterBasketCreate::class ]
            );
            
            // Listen for the event that gets the payment method content
            $eventDispatcher->listen(GetPaymentMethodContent::class,
                    function(GetPaymentMethodContent $event) use( $paymentHelper, $easyCreditPaymentService)
                    {
                        if($event->getMop() == $paymentHelper->getPaymentMethod())
                        { 
                           $event->setValue($easyCreditPaymentService->getRedirectUrl());
                           $event->setType('redirectUrl');
                        }
                    });

            // Listen for the event that executes the payment
            $eventDispatcher->listen(ExecutePayment::class,
               function(ExecutePayment $event) use( $paymentHelper)
               {
                   if($event->getMop() == $paymentHelper->getPaymentMethod())
                   {
                       $event->setValue('<h1>Pay with EasyCredit<h1>');
                       $event->setType('htmlContent');
                   }
               });
       }
    }
