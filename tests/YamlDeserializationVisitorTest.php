<?php

namespace SHyx0rmZ\JMSDeYaml\Test;

use JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use SHyx0rmZ\JMSDeYaml\YamlDeserializationVisitor;

class YamlDeserializationVisitorTest extends \PHPUnit_Framework_TestCase {
    public function testCanDecodeYaml() {
        $namingStrategy = $this->prophesize(PropertyNamingStrategyInterface::class)->reveal();

        $visitor = new YamlDeserializationVisitor($namingStrategy);

        $this->assertEquals([ 'a' => 4, 'b' => 'b', 'c' => true ], $visitor->decode("a: 4\nb: b\nc: true"));
    }
}
