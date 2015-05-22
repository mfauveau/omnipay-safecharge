<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Sale Request
 */
class PurchaseRequest extends AuthorizeRequest
{
    public function getData()
    {
        $data = parent::getData();

        if ($this->getIs3dTrans() === 1) {
            $data['sg_TransType'] = 'Sale3D';
            $data['sg_ApiType'] = 1;
        } else {
            $data['sg_TransType'] = 'Sale';
        }

        return $data;
    }
}
