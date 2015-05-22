<?php

namespace Omnipay\Safecharge;

use Omnipay\Common\AbstractGateway;

/**
 * SafeCharge Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'SafeCharge';
    }

    public function getDefaultParameters()
    {
        return array(
            'username'  => '',
            'password'  => '',
            'testMode'  => false,
            '3DSecure'  => 0,
        );
    }

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


    /**
     * Purchase
     *
     * Sale Request
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\PurchaseRequest', $parameters);
    }

    /**
     * Refund
     *
     * Credit Request
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\RefundRequest', $parameters);
    }

    /**
    * Void
    *
    * Void Request
    */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\VoidRequest', $parameters);
    }

    /**
    * Authorize
    *
    * Auth Request
    */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\AuthorizeRequest', $parameters);
    }

    /**
    * Capture
    *
    * Settle Request
    */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\CaptureRequest', $parameters);
    }

}
