<?php

declare(strict_types=1);

namespace application\common\helpers;

use application\common\enums\DateTimeFormatEnums;
use application\common\enums\TimeZoneEnums;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use DateInterval;
use Exception;

final class DateTimeHelper
{
    /**
     * @throws Exception
     */
    public static function getDateTime(
        string         $date = null,
        ?TimeZoneEnums $timeZone = null
    ): DateTimeInterface
    {
        if (empty($date) && empty($timeZone)) {
            $date = new DateTimeImmutable();
            $date->setTimezone(
                new DateTimeZone(
                    TimeZoneEnums::TIMEZONE_UTC->value
                )
            );
        } elseif (!empty($date) && empty($timeZone)) {
            $date = new DateTimeImmutable($date);
            $date->setTimezone(
                new DateTimeZone(
                    TimeZoneEnums::TIMEZONE_UTC->value
                )
            );
        } elseif (!empty($date) && !empty($timeZone)) {
            $date = new DateTimeImmutable(
                $date,
                new DateTimeZone($timeZone->value)
            );
        } elseif (empty($date) && !empty($timeZone)) {
            $date = new DateTimeImmutable();
            $date = $date->setTimezone(
                new DateTimeZone(
                    $timeZone->value
                )
            );
        }

        return $date;
    }

    public static function toIntervalDate($date): string
    {
        list($year, $month, $day) = sscanf($date, '%d.%d.%d');

        return sprintf('P%dY%dM%dD', $year, $month, $day);
    }

    public static function toIntervalTimeWithSecond($time): string
    {
        list($hours, $minutes) = sscanf($time, '%d:%d');

        return sprintf('PT%dH%dM', $hours, $minutes);
    }

    public static function toIntervalTimeWithoutSecond($time): string
    {
        list($hours, $minutes, $second) = sscanf($time, '%d:%d:%d');

        return  sprintf('PT%dH%dM%dS', $hours, $minutes, $second);
    }

    /**
     * @throws Exception
     */
    public static function addDateTime(
        DateTimeInterface $dateTime,
        string $intervalDateTime
    ) {
        $intervalDateTime = new DateInterval($intervalDateTime);

        return $dateTime->add($intervalDateTime);
    }

    public static function setTime(
        DateTimeInterface $dateTime,
        DateTimeInterface $time,
    ): DateTimeInterface {
        return $dateTime->setTime(
            $time->format((DateTimeFormatEnums::FORMAT_HOUR)->value),
            $time->format((DateTimeFormatEnums::FORMAT_MINUTE)->value),
            $time->format((DateTimeFormatEnums::FORMAT_SECOND)->value),
        );
    }
}
