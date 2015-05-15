<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Settle Request
 */
class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Settle';

        return $data;
    }
}
