<?php

namespace Omnipay\Safecharge\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use SimpleXMLElement;

/**
 * SafeCharge Response.
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;

        if (!class_exists('SimpleXMLElement')) {
            throw new RuntimeException('Insufficient PHP support: missing SimpleXMLElement class');
        }

        try {
            $this->data = new SimpleXMLElement($data);
        } catch (Exception $e) {
            throw new RuntimeException('Failed to parse XML response: '.$e->getMessage());
        }
    }

    public function isSuccessful()
    {
        return $this->data->Status === 'APPROVED';
    }

    public function getTransactionReference()
    {
        return $this->getTransactionId();
    }

    public function getTransactionId()
    {
        return ((string) $this->data->TransactionID != '') ? $this->data->TransactionID : null;
    }

    public function getCode()
    {
        return $this->getAuthCode();
    }

    public function getAuthCode()
    {
        return ((string) $this->data->AuthCode != '') ? $this->data->AuthCode : null;
    }

    public function getToken()
    {
        return ((string) $this->data->Token != '') ? $this->data->Token : null;
    }

    public function getMessage()
    {
        return ((string) $this->data->Reason != '') ? $this->data->Reason : null;
    }
}
