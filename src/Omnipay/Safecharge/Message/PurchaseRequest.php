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

        if ($data['sg_Is3dTrans'] === 0) {
            $data['sg_TransType'] = 'Sale';
        } else {
            $data['sg_TransType'] = 'Sale3D';
            $data['sg_ApiType'] = 1;
        }

        return $data;
    }
}
