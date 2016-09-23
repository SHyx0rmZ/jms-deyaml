<?php

namespace SHyx0rmZ\JMSDeYaml;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\RuntimeException;

class DateTimeHandler extends AbstractYamlDeserializationHandler
{
    /** @var array */
    protected $defaults;

    public function __construct($defaultFormat = \DateTime::ISO8601, $defaultTimezone = 'UTC')
    {
        $this->defaults = array(
            $defaultFormat,
            $defaultTimezone
        );
    }

    public function deserialize(YamlDeserializationVisitor $visitor, $data, array $type, DeserializationContext $context)
    {
        $params = array_replace($this->defaults, $type['params']);
        $format = array_shift($params);
        $timezone = array_shift($params);

        $datetime = \DateTime::createFromFormat($format, (string)$data, new \DateTimeZone($timezone));

        if (false === $datetime) {
            throw new RuntimeException(sprintf('Invalid datetime "%s", expected format %s.', $data, $format));
        }

        return $datetime;
    }
}
