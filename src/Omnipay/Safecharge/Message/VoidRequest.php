<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Void Request
 */
class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Void';

        $this->validate('authCode');

        $data['sg_AuthCode'] = $this->getAuthCode();

        return $data;
    }
}
