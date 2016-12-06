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
            
            $arr["test_response"] = "returned_test_response";
            return $arr;
        }
        
        /**
         * @return array(Street => string, City => string, Zip => int, CountryCode => string)
         */
        public function getBillingAddress()
        {
            
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
