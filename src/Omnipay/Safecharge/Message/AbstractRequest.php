<?php
namespace Omnipay\Safecharge\Message;
/**
 * SafeCharge Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://process.safecharge.com/service.asmx/Process?';
    protected $testEndpoint = 'https://test.safecharge.com/service.asmx/Process?';

    public function getUsername()
    {
        return $this->getParameter('username');
    }
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getData()
    {
        $this->validate('username', 'password');

        $data = array();
        $data['sg_ClientLoginID'] = $this->getUsername();
        $data['sg_ClientPassword'] = $this->getPassword();
        $data['sg_IPAddress'] = '127.0.0.1';
        $data['sg_ResponseFormat'] = 4;
        $data['sg_Is3dTrans'] = 1;
        $data['sg_ClientUniqueID'] = (string) time();

        return $data;
    }

    public function getBillingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            // customer details
            $data['sg_FirstName'] = $card->getBillingFirstName();
            $data['sg_LastName'] = $card->getBillingLastName();
            $data['sg_Address'] = $card->getBillingAddress1();
            $data['sg_City'] = $card->getBillingCity();
            $data['sg_State'] = $card->getBillingState();
            $data['sg_Zip'] = $card->getBillingPostcode();
            $data['sg_Country'] = $card->getBillingCountry();
            $data['sg_Phone'] = $card->getBillingPhone();
            $data['sg_IPAddress'] = $this->getClientIp();
            $data['sg_Email'] = $card->getEmail();
            // shipping details
            $data['sg_Ship_Country'] = $card->getShippingCountry();
            $data['sg_Ship_State'] =  $card->getShippingState();
            $data['sg_Ship_City'] = $card->getShippingCity();
            $data['sg_Ship_Address'] = $card->getShippingAddress1();
            $data['sg_Ship_Zip'] = $card->getShippingPostcode();
        }

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();

        return $this->response = new Response($this, $httpResponse->getBody());
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
