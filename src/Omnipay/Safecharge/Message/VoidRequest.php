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

        return $data;
    }
}
