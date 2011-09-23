<?php
require_once 'chemical.php';

class ChemicalTest extends PHPUnit_Framework_TestCase
{
    private $mendeleevElements = array();

    protected function setUp()
    {
        $chemical = new Chemical();
        $this->mendeleevElements = $chemical->getMendeleevElements();
    }

    private function getFormula($format = false)
    {
        $result = 0;
        $formula = '';
        foreach ($this->mendeleevElements as $element => $mass)
        {
           if ($format)
           {
                $rand = rand(1, 15);    
                $result += $mass*$rand;
                $formula .= $element.$rand; 
           }
           else
           {
                $result += $mass;
                $formula .= $element; 
           }
        }

        return array('formula' => $formula, 'result' => $result);
    }

    public function testSimpleFormula()
    {
        $data = $this->getFormula();

        $chemical = new Chemical($data['formula']);         

        $this->assertEquals($data['result'], $chemical->getMolarMass());
    }

    public function testWithKoeffFormula()
    {
        $data = $this->getFormula(true);

        $chemical = new Chemical($data['formula']);         

        $this->assertEquals($data['result'], $chemical->getMolarMass());
    }
}
?>