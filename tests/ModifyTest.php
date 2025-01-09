<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can modify date',
    function (): void {
        $date = new DateImmutable('1982-01-27');

        $modified = $date->modify('+1 day');

        expect($modified)
            ->toBeInstanceOf(DateImmutable::class)
            ->and($date->format('Y-m-d'))
            ->toBe('1982-01-27')
            ->and($modified->format('Y-m-d'))
            ->toBe('1982-01-28');
    },
);

test(
    'Modify returns false on erroneous argument',
    function (): void {
        $date = new DateImmutable('1982-01-27');

        $exception = null;

        try {
            $date->modify('asdf');
        } catch (DateMalformedStringException $e) {
            $exception = $e;
        }

        expect($exception)->toBeInstanceOf(
            DateMalformedStringException::class,
        );
    },
);
