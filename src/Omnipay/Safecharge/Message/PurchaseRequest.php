<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Sale Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Sale';

        return $data;
    }
}
