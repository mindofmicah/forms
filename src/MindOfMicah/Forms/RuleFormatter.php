<?php
namespace MindOfMicah\Forms;

class RuleFormatter
{
    protected $indent_level = 2;

    public function formatCollection(array $collection)
    {
        $ret = '';
        $glue = $this->getGlue();
        $longest_property_length = $this->maxLengthOfProperties($collection);
       
        foreach ($collection as $property => $rules) {
            $ret.= $glue . $this->formatLine($property, $rules, $longest_property_length);
        }

        return substr($ret, strlen($glue));
    }

    private function getGlue()
    {
        return "\n" . str_repeat("\t", $this->indent_level);
    }

    private function maxLengthOfProperties(array $collection)
    {
        return max(array_map('strlen', array_keys($collection)));
    }
    private function buildSpaces($property, $max_length)
    {
        return str_repeat(' ', $max_length - strlen($property) + 1);
    }
    private function formatLine($property, array $rules, $num_spaces)
    {
        return sprintf(
            "'%s'%s=> '%s'",
            $property,
            $this->buildSpaces($property, $num_spaces),
            implode('|', $rules)
        );
    }
}
