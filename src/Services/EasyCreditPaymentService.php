<?php //strict

namespace EasyCredit\Services;

use Plenty\Modules\Basket\Models\BasketItem;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Models\Payment;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Plugin\Libs\Contracts\LibraryCallContract;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;

use EasyCredit\Helper\OrderInformationHelper;

/**
 * @package EasyCredit\Services
 */
class EasyCreditPaymentService
{
    /**
     * @var LibraryCallContract
     */
    private $libCall;

    /**
     * @var ConfigRepository
     */
    private $config;
    
    /**
     * @var int
     */
    private $shopID;
    
    /**
     * @var string
     */
    private $shopToken;
    
    /**
     * @var array
     */
    private $billingAddress;
    
    /**
     * @var array
     */
    private $deliveryAddress;

    /**
     * @var array
     */
    private $personalData;

    /**
     * @var float
     */
    private $amountOfOrder;
    
    /**
     * @var OrderInformationHelper
     */
    private $orderInfoHelper;

    /**
     * PaymentService constructor.
     *
     * @param ConfigRepository $config
     * @param LibraryCallContract $libCall
     * @param SessionStorageService $sessionStorage
     * @param OrderInformationHelper $orderInfoHelper
     */
    public function __construct(  ConfigRepository $config,
                                  LibraryCallContract $libCall,
                                  OrderInformationHelper $orderInfoHelper)
    {
        $this->libCall                    = $libCall;
        $this->config                     = $config;
        $this->orderInfoHelper            = $orderInfoHelper;
        
        $this->shopID = $this->config->get('EasyCredit.easyCreditShopID');
        $this->shopToken = $this->config->get('EasyCredit.easyCreditShopToken');
    }
    
    public function getRedirectUrl(){
        
        $result = $this->libCall->call('EasyCredit::generateRedirectionUrl', $this->bootstrapOrderInfo());
        $result['url'] = 'http://www.google.com/'.$result;   
        
        return $result;
        
    }
    
    public function bootstrapOrderInfo(){
        $this->billingAddress = $this->orderInfoHelper->getBillingAddress();
        $this->deliveryAddress = $this->orderInfoHelper->getDeliveryAddress();
        $this->personalData = $this->orderInfoHelper->getPersonData();
        $this->amountOfOrder = $this->orderInfoHelper->getAmount();
        
        $allOrderData = array(
            'BillingStreet'         => $this->billingAddress['Street'],
            'BillingCity'           => $this->billingAddress['City'],
            'BillingZip'            => $this->billingAddress['Zip'],
            'BillingCountryCode'    => $this->billingAddress['CountryCode'],
            'DeliveryStreet'        => $this->deliveryAddress['Street'],
            'DeliveryCity'          => $this->deliveryAddress['City'],
            'DeliveryZip'           => $this->deliveryAddress['Zip'],
            'DeliveryCountryCode'   => $this->deliveryAddress['CountryCode'],
            'PersonFirstName'       => $this->personalData['FirstName'],
            'PersonLastName'        => $this->personalData['LastName'],
            'PersonSalutation'      => $this->personalData['Salutation'],
            'AmountOfOrder'         => $this->amountOfOrder,
            'ShopID'                => $this->shopID,
            'ShopToken'             => $this->shopToken,
            );
        
        return $allOrderData;
        
    }
    
}
