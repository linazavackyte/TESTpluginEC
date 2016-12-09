<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
    use Plenty\Modules\Payment\Method\Models\PaymentMethod;
    use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
    use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
    use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;
    
    /**
     * Class OrderInformationHelper
     *
     * @package EasyCredit\Helper
     */
    class OrderInformationHelper
    {
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
            $this->sessionStorage = $FrontendSessionStorageFactoryContract;
            $this->addressRepo = $AddressRepositoryContract;
            $this->basket = $BasketRepositoryContract;
        }
        
        /**
         * @return array(FirstName => string, LastName => string, Salutation => string)
         */
        public function getPersonData()
        {
            $billingAdressId = $this->sessionStorage->getPlugin()->getValue("billingAddressId");
            $personDataDetails = $this->addressRepo->findAddressById($billingAdressId);
            
            $personData = array (
                'FirstName' => $personDataDetails->name2,
                'LastName' => $personDataDetails->name3,
                'Salutation' => 'HERR'
            );
            
            return $personData;
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getBillingAddress()
        { 
            $billingAdressId = $this->sessionStorage->getPlugin()->getValue("billingAddressId");
            $billingAddressDetails = $this->addressRepo->findAddressById($billingAdressId);
            
            $billingAddress = array(
                'Street' => $billingAddressDetails->street.' '.$billingAddressDetails->houseNumber,
                'City' => $billingAddressDetails->town,
                'Zip' => $billingAddressDetails->postalCode,
                'CountryCode' => 'DE'
            );
            
            return $billingAddress;
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getDeliveryAddress()
        {
            $shippingAddressId = $this->sessionStorage->getPlugin()->getValue("deliveryAddressId");
            $shippingAddressDetails = $this->addressRepo->findAddressById($shippingAddressId);
            
            $deliveryAddress = array(
                'Street' => $shippingAddressDetails->street.' '.$shippingAddressDetails->houseNumber,
                'City' => $shippingAddressDetails->town,
                'Zip' => $shippingAddressDetails->postalCode,
                'CountryCode' => 'DE'
            );
            
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
