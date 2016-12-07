<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
    use Plenty\Modules\Payment\Method\Models\PaymentMethod;
    use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
    use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
    use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;
    use Plenty\Modules\Account\Address\Models;
    
    /**
     * Class OrderInformationHelper
     *
     * @package EasyCredit\Helper
     */
    class OrderInformationHelper
    {
        /**
         * @var Models $Models
         */
        private $models;
        
        /**
         * @var FrontendSessionStorageFactoryContract $FrontendSessionStorageFactoryContract
         */
        private $sessionStorage;
        
        /**
         * @var AddressRepositoryContract $AddressRepositoryContract
         */
        private $addressRepo;
        
        /**
         * @var BasketRepositoryContract $BasketRepositoryContract
         */
        private $basket;
        
        /**
         * OrderInformationHelper constructor
         */
        public function __construct(    BasketRepositoryContract $BasketRepositoryContract,
                                        FrontendSessionStorageFactoryContract $FrontendSessionStorageFactoryContract,
                                        AddressRepositoryContract $AddressRepositoryContract)
        {
            $this->models = $Models;
            $this->sessionStorage = $FrontendSessionStorageFactoryContract;
            $this->addressRepo = $AddressRepositoryContract;
            $this->basket = $BasketRepositoryContract;
        }
        
        /**
         * @return array(FirstName => string, LastName => string, Salutation => string)
         */
        public function getPersonData()
        {
            $personData = [];
            $personData->FirstName  = $this->models->name2;
            $personData->LastName   = $this->models->name3;
            $personData->Salutation = 'HERR';
            
            return $personData;
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getBillingAddress()
        { 
            $billingAdressId = $this->sessionStorage->getPlugin()->getValue("billingAddressId");
            $shippingAddressDetails = $this->addressRepo->findAddressById($billingAdressId);
            
            $shippingAddress = [];
            $shippingAddress->Street        = $shippingAddressDetails->street.' '.$shippingAddressDetails->houseNumber;
            $shippingAddress->City          = $shippingAddressDetails->town;
            $shippingAddress->Zip           = $shippingAddressDetails->postalCode;
            $shippingAddress->CountryCode   = 'DE';
            
            return $shippingAddress;
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getDeliveryAddress()
        {
            $shippingAddressId = $this->sessionStorage->getPlugin()->getValue("deliveryAddressId");
            $shippingAddressDetails = $this->addressRepo->findAddressById($shippingAddressId);
            
            $deliveryAddress = [];
            $deliveryAddress->Street        = $shippingAddressDetails->street.' '.$shippingAddressDetails->houseNumber;
            $deliveryAddress->City          = $shippingAddressDetails->town;
            $deliveryAddress->Zip           = $shippingAddressDetails->postalCode;
            $deliveryAddress->CountryCode   = 'DE';
            
            return $deliveryAddress;
        }
        
        /**
         * @return float
         */
        public function getAmount()
        {
            return $this->basket->load()->basketAmount;
        }
    }
