<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can create DateImmutable from "now"',
    function (): void {
        $dateTime = new DateTimeImmutable();

        $date = new DateImmutable();

        expect($date->format('Y-m-d h:i:s'))
            ->toBe($dateTime->format('Y-m-d 12:00:00'));
    },
);

test(
    'Can create DateImmutable from "yesterday"',
    function (): void {
        $dateTime = (new DateTimeImmutable())->sub(
            DateInterval::createFromDateString('1 day'),
        );

        $date = new DateImmutable('yesterday');

        expect($date->format('Y-m-d h:i:s'))
            ->toBe($dateTime->format('Y-m-d 12:00:00'));
    },
);

test(
    'Can create DateImmutable from "2001-02-19"',
    function (): void {
        $date = new DateImmutable('2001-02-19');

        expect($date->format('Y-m-d h:i:s'))
            ->toBe('2001-02-19 12:00:00');
    },
);
