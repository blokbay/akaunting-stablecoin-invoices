<?php

namespace Modules\Blokbay\Services;

class BlokbayException extends \RuntimeException
{
    /** API error code ('number', 'no_wallet', 'links', 'customer'...) or a local one ('not_configured', 'unreachable'...). */
    public string $apiCode;

    public int $status;

    public function __construct(string $message, string $apiCode = 'error', int $status = 0)
    {
        parent::__construct($message);

        $this->apiCode = $apiCode;
        $this->status = $status;
    }
}
