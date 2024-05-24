<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can create from format',
    function (): void {
        $date = DateImmutable::createFromFormat(
            'm/d/y',
            '01/27/82',
        );

        expect($date)
            ->toBeInstanceOf(DateImmutable::class)
            ->and($date->format('Y-m-d'))
            ->toBe('1982-01-27');
    },
);

test(
    'Create from format returns false on erroneous argument',
    function (): void {
        $exception = null;

        try {
            DateImmutable::createFromFormat(
                'm/d/y',
                'foo',
            );
        } catch (Throwable $e) {
            $exception = $e;
        }

        expect($exception)->toBeInstanceOf(
            DateException::class,
        );
    },
);
