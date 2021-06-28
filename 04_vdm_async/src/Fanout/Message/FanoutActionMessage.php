<?php

namespace App\Fanout\Message;

use Vdm\Bundle\LibraryBundle\Model\Message;

class FanoutActionMessage extends Message
{
    public function __construct($payload = null, array $metadatas = [], array $traces = [])
    {
        parent::__construct($payload, $metadatas, $traces);
    }
}