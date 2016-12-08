<?php

    $personFirstName = strval(SdkRestApi::getParam('PersonFirstName', true));
    $personLastName = strval(SdkRestApi::getParam('PersonLastName', true));
    $personSalutation = strval(SdkRestApi::getParam('PersonSalutation', true));
    $billingStreet = strval(SdkRestApi::getParam('BillingStreet', true));
    $billingCity = strval(SdkRestApi::getParam('BillingCity', true));
    $billingZip = strval(SdkRestApi::getParam('BillingZip', true));
    $billingCountryCode = strval(SdkRestApi::getParam('BillingCountry', true));
    $deliveryStreet = strval(SdkRestApi::getParam('DeliveryStreet', true));
    $deliveryCity = strval(SdkRestApi::getParam('DeliveryCity', true));
    $deliveryZip = strval(SdkRestApi::getParam('DeliveryZip', true));
    $deliveryCountryCode = strval(SdkRestApi::getParam('DeliveryCountryCode', true));
    $amountOfOrder = strval(SdkRestApi::getParam('AmountOfOrder', true));
    $shopID = strval(SdkRestApi::getParam('ShopID', true));
    $shopToken = strval(SdkRestApi::getParam('ShopToken', true));
    
    $requestAdapter = new \EasyCredit\Http\Adapter\Curl();

    $dataMapper = new \EasyCredit\Api\DataMapper();

    $request = new EasyCredit\Http\Request(
        \EasyCredit\Config::EASYCREDIT_API_HOSTNAME,
        \EasyCredit\Config::EASYCREDIT_API_PORT,
        $requestAdapter
    );

    $apiClient = new \EasyCredit\Api\ApiClient(
        $shopID,
        $shopToken,
        $request,
        $dataMapper
    );

    $personaData = new \EasyCredit\Transfer\PersonData();
    $personaData->setFirstName($personFirstName);
    $personaData->setLastName($personLastName);
    $personaData->setSalutation($personSalutation);

    $billingAddress = new \EasyCredit\Transfer\BillingAddress();
    $billingAddress->setStreet($billingStreet);
    $billingAddress->setCity($billingCity);
    $billingAddress->setZip($billingZip);
    $billingAddress->setCountryCode($billingCountryCode);

    $deliveryAddress = new \EasyCredit\Transfer\DeliveryAddress();
    $deliveryAddress->setStreet($deliveryStreet);
    $deliveryAddress->setCity($deliveryCity);
    $deliveryAddress->setZip($deliveryZip);
    $deliveryAddress->setCountryCode($deliveryCountryCode);

    $processInitialize = new \EasyCredit\Transfer\ProcessInitialize();
    $processInitialize->setPersonData($personaData);
    $processInitialize->setBillingAddress($billingAddress);
    $processInitialize->setDeliveryAddress($deliveryAddress);
    $processInitialize->setAmount($amountOfOrder);
    $processInitialize->setShopId($shopID);

    $processInitializeResponse = $apiClient->init($processInitialize);

    $tVorgang = $processInitializeResponse -> getTbProcessIdentifier();

    $newURL ='https://ratenkauf.easycredit.de/ratenkauf/content/intern/einstieg.jsf?vorgangskennung=' .$tVorgang;

    return $newURL;

?>