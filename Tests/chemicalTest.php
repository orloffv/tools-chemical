<?php
require_once ('src/chemical.php');

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

    public function testWithWhitespaceInFormula()
    {
        $chemical = new Chemical('H 2');
        $result = $this->mendeleevElements['H']*2;
        $this->assertEquals($result, $chemical->getMolarMass());

        $chemical = new Chemical(' H  2 ');
        $result = $this->mendeleevElements['H']*2;
        $this->assertEquals($result, $chemical->getMolarMass());
    }

    public function testWithBracketsInFormula()
    {
        $chemical = new Chemical('(H2)2');
        $result = $this->mendeleevElements['H']*4;
        $this->assertEquals($result, $chemical->getMolarMass());

        $chemical = new Chemical('(H2SO4)2H2');
        $result = $this->mendeleevElements['H']*6 + $this->mendeleevElements['S'] * 2 + $this->mendeleevElements['O'] * 8;
        $this->assertEquals($result, $chemical->getMolarMass());

        $chemical = new Chemical('Mg3(H2SO4)2H2');
        $result = $this->mendeleevElements['Mg']*3 + $this->mendeleevElements['H']*6 + $this->mendeleevElements['S'] * 2 + $this->mendeleevElements['O'] * 8;
        $this->assertEquals($result, $chemical->getMolarMass());
    }
}
?>