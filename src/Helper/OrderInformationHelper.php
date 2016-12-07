<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
    use Plenty\Modules\Payment\Method\Models\PaymentMethod;
    use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;

    /**
     * Class OrderInformationHelper
     *
     * @package EasyCredit\Helper
     */
    class OrderInformationHelper
    {
        /**
         * @var BasketRepositoryContract $BasketRepositoryContract
         */
        private $basketContract;
        
        /**
         * OrderInformationHelper constructor
         */
        public function __construct(BasketRepositoryContract $BasketRepositoryContract)
        {
            $this->basketContract = $BasketRepositoryContract;
        }
        
        /**
         * @return array(FirstName => string, LastName => string, Salutation => string)
         */
        public function getPersonData()
        {
            
            
            return ['FirstName' => 'Max', 'LastName' => 'Mustermann', 'Salutation' => 'HERR'];
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getBillingAddress()
        { 
            
            
            return ['Street' => 'Beuthener Str. 25', 'City' => 'Nürnberg', 'Zip' => 90471, 'CountryCode' => 'DE'];
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getDeliveryAddress()
        {
            
            
            return ['Street' => 'Beuthener Str. 25', 'City' => 'Nürnberg', 'Zip' => 90471, 'CountryCode' => 'DE'];
        }
        
        /**
         * @return float
         */
        public function getAmount()
        {
            $basket = $this->basketContract->all();
            
            return 299.99;
        }
    }
