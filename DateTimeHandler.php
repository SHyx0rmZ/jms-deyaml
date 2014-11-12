<?php

namespace SHyx0rmZ\JMSDeYaml;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\RuntimeException;

class DateTimeHandler extends AbstractYamlDeserializationHandler
{
    /** @var string */
    protected $defaultFormat;
    /** @var string */
    protected $defaultTimezone;

    public function __construct($defaultFormat = \DateTime::ISO8601, $defaultTimezone = 'UTC')
    {
        $this->defaultFormat = $defaultFormat;
        $this->defaultTimezone = $defaultTimezone;
    }

    public function deserialize(YamlDeserializationVisitor $visitor, $data, array $type, DeserializationContext $context)
    {
        if ($data === null) {
            return null;
        }

        $format = isset($type['params'][0]) ? $type['params'][0] : $this->defaultFormat;
        $timezone = isset($type['params'][1]) ? $type['params'][1] : $this->defaultTimezone;

        $datetime = \DateTime::createFromFormat($format, (string)$data, new \DateTimeZone($timezone));

        if (false === $datetime) {
            throw new RuntimeException(sprintf('Invalid datetime "%s", expected format %s.', $data, $format));
        }

        return $datetime;
    }
}
