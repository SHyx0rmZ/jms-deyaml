<?php

namespace SHy\JMSDeYaml;

use JMS\Serializer\GenericDeserializationVisitor;
use Symfony\Component\Yaml\Yaml;

class YamlDeserializationVisitor extends GenericDeserializationVisitor
{
    public function decode($data)
    {
        $yaml = new Yaml();
        return $yaml->parse($data);
    }
}
