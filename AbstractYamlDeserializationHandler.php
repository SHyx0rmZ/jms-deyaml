<?php

namespace SHyx0rmZ\JMSDeYaml;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;

abstract class AbstractYamlDeserializationHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'type' => \DateTime::class,
                'format' => 'yml',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'method' => 'deserialize',
            )
        );
    }

    abstract public function deserialize(YamlDeserializationVisitor $visitor, $data, array $type, DeserializationContext $context);
}
