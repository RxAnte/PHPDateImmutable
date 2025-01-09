<?php

if (!class_exists(DateMalformedStringException::class)) {
    class DateMalformedStringException extends DateException
    {
    }
}
