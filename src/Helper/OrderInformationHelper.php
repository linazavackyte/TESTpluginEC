<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
    use Plenty\Modules\Payment\Method\Models\PaymentMethod;

    /**
     * Class OrderInformationHelper
     *
     * @package EasyCredit\Helper
     */
    class OrderInformationHelper
    {
        /**
         * @var $personData
         */
        private $personData;
        
        /**
         * @var $billingAddress
         */
        private $billingAddress;
        
        /**
         * @var $deliveryAddress
         */
        private $deliveryAddress;
        
        /**
         * @var $amount
         */
        private $amount;
        
        /**
         * OrderInformation constructor
         * 
         * @param $personData
         * @param $billingAddress
         * @param $deliveryAddress
         * @param $amount
         */
        public function __construct()
        {
            // $this->personData       = $personData;
            // $this->billingAddress    = $billingAddress;
            // $this->deliveryAddress  = $deliveryAddress;
            // $this->amount           = $amount;
        }
        
        /**
         * @return array(FirstName => string, LastName => string, Salutation => string)
         */
        public function getPersonData()
        {
            
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getBillingAddress()
        { 
            // $billingAddress = $this->sessionStorage->getPlugin()->getValue("billingAddressId");
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getDeliveryAddress()
        {
            
        }
        
        /**
         * @return float
         */
        public function getAmount()
        {
            
        }
    }
