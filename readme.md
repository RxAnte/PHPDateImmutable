# PHPDateImmutable

This is an implementation of a `DateImmutable` class that deals only with dates and not with time. PHP has, of course, built-in, `DateTime` and `DateTimeImmutable` classes. We have found that we frequently want a class that deals only with the date.

This `DateImmutable` class implements all the same methods that PHP's `DateTimeImmutable` does, and in the same way, except where the method wouldn't make sense for a class that does not deal with time.

## Methods

### The Constructor

`DateImmutable`'s constructor works exactly the same way as `DateTimeImmutable`'s does, except that it does not accept a `DateTimeZone` as a second argument because timezones do not matter when you're not dealing with time.

```php
$today = new \RxAnte\DateImmutable('now');
$specificDate = new \RxAnte\DateImmutable('2008-04-29');
```

### `diff` (instance method)

Returns the difference between its own instance, and another instance of either `DateImmutable` or the `DateTimeInterface`

```php
$dateTime = new \DateTimeImmutable('2006-03-20 02:03:04');

$date = new \RxAnte\DateImmutable('2001-02-19');

$diff = $date->diff($dateTime);

// OR

$anotherDate = $date = new \RxAnte\DateImmutable('2001-02-12');

$diff2 = $date->diff($anotherDate);
```

### `format` (instance method)

Takes all the same options that PHP's `DateTimeInterface` does: https://www.php.net/manual/en/datetime.format.php

If any time formatting tokens are used, 0s will always be returned since there is no time on the `DateImmutable` class.

```php
$date = new \RxAnte\DateImmutable('2008-04-29');

$format = $date->format('Y-m-d h:i:s'); // outputs 2008-04-29 12:00:00
```

### `getTimestamp` (instance method)

Gets the unix timestamp of UTC midnight for the given date.

```php
$date = new \RxAnte\DateImmutable('2008-04-29 08:22:23')

$timestamp = $date->getTimestamp(); // outputs 1209427200
```

### `add` (instance method)

Adds an amount of days, months, and years to the existing instance's value, and returns a new instance with the new values.

Any hours, minutes, or seconds on the `DateInterval` argument input will be ignored.

```php
$date = (new \RxAnte\DateImmutable('2008-04-29 08:22:23'))
    ->add(\DateInterval::createFromDateString('1 week'));

$formatted = $date->format('Y-m-d'); // outputs 2008-05-06
```

### `createFromFormat` (static method)

Returns new DateImmutable object formatted according to the specified format.

Takes all the same options that PHP's `DateTimeImmutable` does: https://www.php.net/manual/en/datetime.format.php

```php
$date = \RxAnte\DateImmutable::createFromFormat(
    'm/d/y',
    '01/27/82',
);
```

### `modify` (instance method)

Creates a new instance of `DateImmutable` modified by the input.

Takes all the same options that PHP's `DateTime` classes do: https://www.php.net/manual/en/datetime.formats.php

```php
$date = new \RxAnte\DateImmutable('1982-01-27');

$modified = $date->modify('+1 day');
```

### `setDate` (instance method)

Sets the date to the input year/month/day and returns a new instance of the class with that value.

```php
$date = new \RxAnte\DateImmutable('1982-01-27');

$newDate = $date->setDate(2002, 2, 3);
```

### `setISODate` (instance method)

Sets the date to the input year/week/dayOfWeek and returns a new instance of the class with that value.

```php
$date = new \RxAnte\DateImmutable('1982-01-27');

$newDate = $date->setISODate(2005, 30, 2);
```

### `sub` (instance method)

Subtracts an amount of days, months, and years from the existing instance's value, and returns a new instance with the new values.

Any hours, minutes, or seconds on the `DateInterval` argument input will be ignored.

```php
$date = (new \RxAnte\DateImmutable('2008-04-29'))
    ->sub(\DateInterval::createFromDateString('1 week'));

$formatted = $date->format('Y-m-d'); // outputs 2008-04-22
```
