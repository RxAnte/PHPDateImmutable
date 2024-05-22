<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can subtract date interval',
    function (): void {
        $date = (new DateImmutable('2008-04-29'))
            ->sub(DateInterval::createFromDateString('1 week'));

        expect($date->format('Y-m-d'))
            ->toBe('2008-04-22');
    },
);
