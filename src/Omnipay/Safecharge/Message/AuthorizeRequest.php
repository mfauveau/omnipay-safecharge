<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Auth Request
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Auth';

        return $data;
    }
}
