<?php //strict

    namespace EasyCredit\Helper;

    use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
    use Plenty\Modules\Basket\Models\Basket;

    /**
     * Class BasketHelper
     *
     * @package EasyCredit\Helper
     */
    class BasketHelper
    {
        
        /**
         * @var BasketRepositoryContract $basketRepositoryContract
         */
        private $basketRepositoryContract;

        /**
         * BasketHelper constructor.
         *
         * @param BasketRepositoryContract $basketRepositoryContract
         */
        public function __construct(BasketRepositoryContract $basketRepositoryContract)
        {
            $this->basketRepositoryContract = $basketRepositoryContract;
        }
        
        /**
         * Check if sum of items and shipping in the basket is above the required amount
         * 
         * @return boolean
         **/
        public function checkIfCorrectBasketAmount(){
            
            $basket = $this->basketRepositoryContract->load();
            
            if($basket->basketAmount >= 200.00){
                return true;
            } else {
                return false;
            }
            
        }
    }