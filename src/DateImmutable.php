<?php

declare(strict_types=1);

namespace RxAnte;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;

// phpcs:disable SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingTraversableTypeHintSpecification
// phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification

readonly class DateImmutable
{
    private const CREATE_FORMAT = 'Y-m-d 00:00:00';

    private DateTimeImmutable $dateTime;

    /**
     * @param string $time [optional] A date/time string. Valid formats are
     * explained in {@link https://secure.php.net/manual/en/datetime.formats.php
     * Date and Time Formats}.
     *
     * @throws Exception Emits Exception in case of an error.
     */
    public function __construct(string $time = 'now')
    {
        $this->dateTime = new DateTimeImmutable(
            (new DateTimeImmutable($time))->format(
                self::CREATE_FORMAT,
            ),
            new DateTimeZone('UTC'),
        );
    }

    public function __serialize(): array
    {
        return $this->dateTime->__serialize();
    }

    /**
     * @throws Exception
     *
     * @phpstan-ignore-next-line
     */
    public function __unserialize(array $data): void
    {
        $this->__construct($data['date']);
    }

    /**
     * Returns the difference between two Date objects
     *
     * @link https://secure.php.net/manual/en/datetime.diff.php
     */
    public function diff(
        DateTimeInterface|DateImmutable $targetObject,
        bool $absolute = false,
    ): DateInterval {
        if ($targetObject instanceof DateImmutable) {
            $targetObject = $targetObject->dateTime;
        }

        return $this->dateTime->diff(
            $targetObject,
            $absolute,
        );
    }

    public function format(string $format): string
    {
        return $this->dateTime->format($format);
    }

    /**
     * Gets the Unix timestamp
     */
    public function getTimestamp(): int
    {
        return $this->dateTime->getTimestamp();
    }

    /**
     * Adds an amount of days, months, and years
     *
     * @link https://secure.php.net/manual/en/datetimeimmutable.add.php
     *
     * @throws Exception
     */
    public function add(DateInterval $interval): DateImmutable
    {
        $newDateTime = $this->dateTime->add($interval)->setTime(
            0,
            0,
            0,
        );

        return new DateImmutable($newDateTime->format(
            self::CREATE_FORMAT,
        ));
    }

    /**
     * Returns new DateImmutable object formatted according to the specified
     * format
     *
     * @link https://secure.php.net/manual/en/datetimeimmutable.createfromformat.php
     *
     * @throws Exception
     */
    public static function createFromFormat(
        string $format,
        string $datetime,
    ): DateImmutable|false {
        $dateTime = DateTimeImmutable::createFromFormat(
            $format,
            $datetime,
            new DateTimeZone('UTC'),
        );

        if ($dateTime === false) {
            return false;
        }

        return new DateImmutable(
            $dateTime->format(self::CREATE_FORMAT),
        );
    }

    /**
     * @param string $modifier A date/time string. Valid formats are explained
     * in {@link https://secure.php.net/manual/en/datetime.formats.php Date and
     * Time Formats}.
     *
     * @return DateImmutable|false Returns the newly created object or false on failure.
     *
     * @throws Exception
     */
    public function modify(string $modifier): DateImmutable|false
    {
        $newDateTime = $this->dateTime->modify($modifier);

        if ($newDateTime === false) {
            return false;
        }

        $newDateTime = $newDateTime->setTime(
            0,
            0,
            0,
        );

        return new DateImmutable($newDateTime->format(
            self::CREATE_FORMAT,
        ));
    }

    /** @throws Exception */
    public function setDate(int $year, int $month, int $day): DateImmutable
    {
        $newDateTime = $this->dateTime->setDate(
            $year,
            $month,
            $day,
        );

        return new DateImmutable($newDateTime->format(
            self::CREATE_FORMAT,
        ));
    }

    /** @throws Exception */
    public function setISODate(
        int $year,
        int $week,
        int $dayOfWeek = 1,
    ): DateImmutable {
        $newDateTime = $this->dateTime->setISODate(
            $year,
            $week,
            $dayOfWeek,
        );

        return new DateImmutable($newDateTime->format(
            self::CREATE_FORMAT,
        ));
    }

    /**
     * Subtracts an amount of days, months, and years
     *
     * @throws Exception
     */
    public function sub(DateInterval $interval): DateImmutable
    {
        $newDateTime = $this->dateTime->sub($interval)->setTime(
            0,
            0,
            0,
        );

        return new DateImmutable($newDateTime->format(
            self::CREATE_FORMAT,
        ));
    }
}
