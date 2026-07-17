<?php

namespace App\Queue;

use Illuminate\Queue\Failed\DatabaseUuidFailedJobProvider;
use Illuminate\Support\Facades\Date;

class UuidFailedJobProvider extends DatabaseUuidFailedJobProvider
{
    public function log($connection, $queue, $payload, $exception): ?string
    {
        $uuid = json_decode($payload, true, 512, JSON_THROW_ON_ERROR)['uuid'];

        $this->getTable()->insert([
            'id' => $uuid,
            'uuid' => $uuid,
            'connection' => $connection,
            'queue' => $queue,
            'payload' => $payload,
            'exception' => (string) mb_convert_encoding($exception, 'UTF-8'),
            'failed_at' => Date::now(),
        ]);

        return $uuid;
    }
}
