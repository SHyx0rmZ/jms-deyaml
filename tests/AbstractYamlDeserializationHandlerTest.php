<?php

namespace SHyx0rmZ\JMSDeYaml\Test;

use JMS\Serializer\GraphNavigator;
use SHyx0rmZ\JMSDeYaml\AbstractYamlDeserializationHandler;

class AbstractYamlDeserializationVisitorTest extends \PHPUnit_Framework_TestCase {
    public function testCanDecodeYaml() {
        $handler = $this->getMockForAbstractClass(AbstractYamlDeserializationHandler::class);

        $methods = [
            [
                'type' => \DateTime::class,
                'format' => 'yml',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'method' => 'deserialize',
            ]
        ];

        $this->assertEquals($methods, $handler->getSubscribingMethods());
    }
}
