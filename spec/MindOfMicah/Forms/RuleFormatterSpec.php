<?php

namespace spec\MindOfMicah\Forms;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RuleFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Forms\RuleFormatter');
    }

    public function it_should_format_a_collection_of_rules_having_one_property_with_one_rule()
    {
        $input = [
            'property' => ['rule']
        ];
        $expected = "'property' => 'rule'";
        $this->formatCollection($input)->shouldEqual($expected);
    }
    public function it_should_format_a_property_with_multiple_rules()
    {
        $input = [
            'prop' => [
                'rule1', 'rule2'
            ]
        ];
        $expected = "'prop' => 'rule1|rule2'";
        $this->formatCollection($input)->shouldEqual($expected);
    }

    public function it_should_handle_multiple_properties()
    {
        $input = [
            'prop1' => ['rule'],
            'prop2' => ['rule']
        ];
        $expected = "'prop1' => 'rule'\n\t\t'prop2' => 'rule'";
        $this->formatCollection($input)->shouldEqual($expected);
    }
    public function it_should_auto_format_multiple_properties()
    {
        $input = [
            'p' => ['rule'],
            'i like turtles' => ['rule']
        ];
        $expected = "'p'              => 'rule'\n\t\t";
        $expected.= "'i like turtles' => 'rule'";
        $this->formatCollection($input)->shouldEqual($expected);
    }
}
