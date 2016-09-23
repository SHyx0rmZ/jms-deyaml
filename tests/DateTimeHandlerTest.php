<?php

namespace SHyx0rmZ\JMSDeYaml\Test;

use JMS\Serializer\DeserializationContext;
use SHyx0rmZ\JMSDeYaml\DateTimeHandler;
use SHyx0rmZ\JMSDeYaml\YamlDeserializationVisitor;

class DateTimeHandlerTest extends \PHPUnit_Framework_TestCase {
    public function testCanDeserializeADateTimeWithDefaults() {
        $handler = new DateTimeHandler();

        $context = $this->prophesize(DeserializationContext::class)->reveal();
        $visitor = $this->prophesize(YamlDeserializationVisitor::class)->reveal();

        $result = $handler->deserialize(
            $visitor,
            '2016-09-23T17:45:00+0000',
            [
                'type' => 'DateTime',
                'params' => []
            ],
            $context
        );

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals(new \DateTime('2016-09-23 17:45:00', new \DateTimeZone('UTC')), $result);
    }

    public function testCanDeserializeADateTimeWithCustomFormat() {
        $handler = new DateTimeHandler();

        $context = $this->prophesize(DeserializationContext::class)->reveal();
        $visitor = $this->prophesize(YamlDeserializationVisitor::class)->reveal();

        $result = $handler->deserialize(
            $visitor,
            '20160923 % 174500',
            [
                'type' => 'DateTime',
                'params' => [
                    'Ymd % His'
                ]
            ],
            $context
        );

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals(new \DateTime('2016-09-23 17:45:00', new \DateTimeZone('UTC')), $result);
    }

    public function testCanDeserializeADateTimeWithCustomTimeZone() {
        $handler = new DateTimeHandler();

        $context = $this->prophesize(DeserializationContext::class)->reveal();
        $visitor = $this->prophesize(YamlDeserializationVisitor::class)->reveal();

        $result = $handler->deserialize(
            $visitor,
            '20160923 % 174500',
            [
                'type' => 'DateTime',
                'params' => [
                    'Ymd % His',
                    'CET'
                ]
            ],
            $context
        );

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertNotEquals(new \DateTime('2016-09-23 17:45:00', new \DateTimeZone('UTC')), $result);
        $this->assertEquals(new \DateTime('2016-09-23 17:45:00', new \DateTimeZone('CET')), $result);
    }
}
