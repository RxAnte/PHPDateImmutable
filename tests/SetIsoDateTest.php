<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can set date',
    function (): void {
        $date = new DateImmutable('1982-01-27');

        $newDate = $date->setISODate(2005, 30, 2);

        expect($date->format('Y-m-d'))
            ->toBe('1982-01-27')
            ->and($newDate->format('Y-m-d'))
            ->toBe('2005-07-26');
    },
);
