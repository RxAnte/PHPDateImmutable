<?php

declare(strict_types=1);

namespace RxAnte;

use DateException;
use DateInterval;
use DateMalformedStringException;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;

use function implode;
use function is_array;
use function mb_strpos;
use function restore_error_handler;
use function set_error_handler;
use function version_compare;

use const PHP_VERSION;

// phpcs:disable SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingTraversableTypeHintSpecification
// phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
// phpcs:disable SlevomatCodingStandard.Functions.StaticClosure.ClosureNotStatic

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
    ): DateImmutable {
        $dateTime = DateTimeImmutable::createFromFormat(
            $format,
            $datetime,
            new DateTimeZone('UTC'),
        );

        if ($dateTime === false) {
            $lastErrors = DateTimeImmutable::getLastErrors();
            $lastErrors = is_array($lastErrors) ? $lastErrors : [];
            $errors     = $lastErrors['errors'] ?? [];

            throw new DateException(implode(
                '. ',
                $errors,
            ));
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
     * @throws DateMalformedStringException
     */
    public function modify(string $modifier): DateImmutable
    {
        $oldErrorHandler = null;

        // For PHP 8.2's terrible handling of emitting warnings
        if (
            version_compare(
                PHP_VERSION,
                '8.3.0',
                '<',
            )
        ) {
            $oldErrorHandler = set_error_handler(
                function (
                    int $code,
                    string $msg,
                    string $file,
                    int $line,
                ) use (&$oldErrorHandler): bool {
                    $applicable = mb_strpos(
                        $msg,
                        'DateTimeImmutable::modify()',
                    );

                    if ($applicable !== false) {
                        throw new DateMalformedStringException();
                    }

                    // @codeCoverageIgnoreStart

                    /** @phpstan-ignore-next-line */
                    return $oldErrorHandler($code, $msg, $file, $line);
                    // @codeCoverageIgnoreEnd
                },
            );
        }

        $newDateTime = $this->dateTime->modify($modifier);

        if (
            version_compare(
                PHP_VERSION,
                '8.3.0',
                '<',
            )
        ) {
            restore_error_handler();
        }

        $newDateTime = $newDateTime->setTime(
            0,
            0,
            0,
        );

        /**
         * We know this isn't going to throw because we know we have a valid
         * DateTime at this point
         *
         * @noinspection PhpUnhandledExceptionInspection
         */
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
