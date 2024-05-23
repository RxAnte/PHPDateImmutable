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
            ->toBeInstanceOf(DateImmutable::class);

        assert($date instanceof DateImmutable);

        expect($date->format('Y-m-d'))
            ->toBe('1982-01-27');
    },
);
