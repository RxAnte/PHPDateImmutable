<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can serialize and deserialize object',
    function (): void {
        $date = new DateImmutable('2001-02-19');

        $serialized = serialize($date);

        expect($serialized)->toBe(
            'O:20:"RxAnte\DateImmutable":3:{s:4:"date";s:26:"2001-02-19 00:00:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:3:"UTC";}',
        );

        $unserialized = unserialize($serialized);

        assert($unserialized instanceof DateImmutable);

        expect($unserialized)
            ->toBeInstanceOf(DateImmutable::class)
            ->and($date->format('Y-m-d h:i:s'))
            ->toBe('2001-02-19 12:00:00');
    },
);
