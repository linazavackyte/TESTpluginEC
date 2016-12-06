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
            return 299.99;
        }
    }
