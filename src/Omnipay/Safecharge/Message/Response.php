<?php
namespace Omnipay\Safecharge\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
/**
 * SafeCharge Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        parse_str($data, $this->data);
    }
}
