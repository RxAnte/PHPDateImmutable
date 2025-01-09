<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can format date',
    function (): void {
        $date = new DateImmutable('2008-04-29 08:22:23');

        expect($date->format('Y-m-d h:i:s'))
            ->toBe('2008-04-29 12:00:00');
    },
);
