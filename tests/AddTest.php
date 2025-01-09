<?php

declare(strict_types=1);

use RxAnte\DateImmutable;

test(
    'Can add date interval',
    function (): void {
        $date = (new DateImmutable('2008-04-29 08:22:23'))
            ->add(DateInterval::createFromDateString('1 week'));

        expect($date->format('Y-m-d h:i:s'))
            ->toBe('2008-05-06 12:00:00');
    },
);
