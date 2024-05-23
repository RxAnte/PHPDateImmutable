<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can get timestamp',
    function (): void {
        $date = new DateImmutable('2008-04-29 08:22:23');

        expect($date->getTimestamp())
            ->toBe(1209427200);
    },
);
