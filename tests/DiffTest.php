<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can diff with a DateTimeInterface',
    function (): void {
        $dateTime = new DateTimeImmutable('2006-03-20 02:03:04');

        $date = new DateImmutable('2001-02-19');

        $diff = $date->diff($dateTime);

        expect($diff->y)
            ->toBe(5)
            ->and($diff->m)
            ->toBe(1)
            ->and($diff->d)
            ->toBe(1)
            ->and($diff->h)
            ->toBe(2)
            ->and($diff->i)
            ->toBe(3)
            ->and($diff->s)
            ->toBe(4)
            ->and($diff->invert)
            ->toBe(0)
            ->and($diff->days)
            ->toBe(1855);
    },
);

test(
    'Can diff with another DateImmutable',
    function (): void {
        $diffWith = new DateImmutable('2008-11-03');

        $date = new DateImmutable('2001-02-19');

        $diff = $date->diff($diffWith);

        expect($diff->y)
            ->toBe(7)
            ->and($diff->m)
            ->toBe(8)
            ->and($diff->d)
            ->toBe(15)
            ->and($diff->h)
            ->toBe(0)
            ->and($diff->i)
            ->toBe(0)
            ->and($diff->s)
            ->toBe(0)
            ->and($diff->invert)
            ->toBe(0)
            ->and($diff->days)
            ->toBe(2814);
    },
);
