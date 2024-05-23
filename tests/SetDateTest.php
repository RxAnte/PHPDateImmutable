<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can set date',
    function (): void {
        $date = new DateImmutable('1982-01-27');

        $newDate = $date->setDate(2002, 2, 3);

        expect($date->format('Y-m-d'))
            ->toBe('1982-01-27')
            ->and($newDate->format('Y-m-d'))
            ->toBe('2002-02-03');
    },
);
