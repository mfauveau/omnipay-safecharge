<?php
namespace Omnipay\Safecharge\Message;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * SafeCharge Complete Authorize Request
 */
class CompleteAuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array(
            'sg_TransactionID' => $this->httpRequest->request->get('TransactionID'),
            'sg_PARes' => $this->httpRequest->request->get('PaRes'), // inconsistent caps are intentional
        );

        if (empty($data['sg_TransactionID']) || empty($data['sg_PARes'])) {
            throw new InvalidResponseException;
        }

        return $data;
    }
}
