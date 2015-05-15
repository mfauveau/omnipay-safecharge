<?php

namespace Omnipay\Safecharge;

use Omnipay\Common\AbstractGateway;

/**
 * SafeCharge Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'SafeCharge';
    }

    public function getDefaultParameters()
    {
        return array(
            'testMode'                  => false
        );
    }

}
