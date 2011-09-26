<?php
class Chemical {
	
	private $mendeleevElements = array
	(
		"H"  => "1.00794",
		"He" => "4.002602",
		"Li" => "6.941",
		"Be" => "9.012182",
		"B"  => "10.811",
		"C"  => "12.011",
		"N"  => "14.00674",
		"O"  => "15.9994",
		"F"  => "18.9984032",
		"Ne" => "20.1797",
		"Na" => "22.989768",
		"Mg" => "24.3050",
		"Al" => "26.981539",
		"Si" => "28.0855",
		"P"  => "30.973762",
		"S"  => "32.066",
		"Cl" => "35.4527",
		"Ar" => "39.948",
		"K"  => "39.0983",
		"Ca" => "40.078",
		"Sc" => "44.955910",
		"Ti" => "47.88",
		"V"  => "50.9415",
		"Cr" => "51.9961",
		"Mn" => "54.93805",
		"Fe" => "55.847",
		"Co" => "58.93320",
		"Ni" => "58.6934",
		"Cu" => "63.546",
		"Zn" => "65.39",
		"Ga" => "69.723",
		"Ge" => "72.61",
		"As" => "74.92159",
		"Se" => "78.96",
		"Br" => "79.904",
		"Kr" => "83.80",
		"Rb" => "85.4678",
		"Sr" => "87.62",
		"Y"  => "88.90585",
		"Zr" => "91.224",
		"Nb" => "92.90638",
		"Mo" => "95.94",
		"Tc" => "98.906",
		"Ru" => "101.07",
		"Rh" => "102.90550",
		"Pd" => "106.42",
		"Ag" => "107.8682",
		"Cd" => "112.411",
		"In" => "114.82",
		"Sn" => "118.710",
		"Sb" => "121.757",
		"Te" => "127.60",
		"I"  => "126.90447",
		"Xe" => "131.29",
		"Cs" => "132.90543",
		"Ba" => "137.327",
		"La" => "138.9055",
		"Ce" => "140.115",
		"Pr" => "140.90765",
		"Nd" => "144.24",
		"Pm" => "146.91",
		"Sm" => "150.36",
		"Eu" => "151.965",
		"Gd" => "157.25",
		"Tb" => "158.92534",
		"Dy" => "162.50",
		"Ho" => "164.93032",
		"Er" => "167.26",
		"Tm" => "168.93421",
		"Yb" => "173.04",
		"Lu" => "174.967",
		"Hf" => "178.49",
		"Ta" => "180.9479",
		"W"  => "183.85",
		"Re" => "186.207",
		"Os" => "190.2",
		"Ir" => "192.22",
		"Pt" => "195.08",
		"Au" => "196.96654",
		"Hg" => "200.59",
		"Tl" => "204.3833",
		"Pb" => "207.2",
		"Bi" => "208.98037",
		'Po' => "208.98",
		'At' => "209.98",
		'Rn' => "222.01",
		'Fr' => "223.01",
		"Ra" => "226.0254",
		'Ac' => "227.02",
		"Th" => "232.0381",
		"Pa" => "213.0359",
		"U"  => "238.0289",
		"Np" => "237.0482",
		'Pu' => "244.06",
		'Am' => "243.06",
		'Cm' => "247.07",
		'Bk' => "247.07",
		'Cf' => "251.07",
		'Es' => "252.08",
		'Fm' => "257.09",
		'Md' => "258.09",
		'No' => "259.10",
		'Lr' => "260.10",
		"Rf" => "261",
		"Db" => "262",
		"Sg" => "263",
		"Bh" => "262",
		"Hs" => "265",
		"Mt" => "266",
	);

	private $formula;
	private $elements = array();

	function __construct($formula = NULL) 
	{
		if ( ! is_null($formula))
		{
			$this->formula = $this->clear($formula);
			$this->parseFormula($this->formula);	
		}
	}
	
	public function getMendeleevElements()
	{
		return $this->mendeleevElements;
	}

	private function addElement($element, $count = 1)
	{
		$this->elements[] = array($element, $count);
	}

	private function findElements($formula, $offset = 1)
	{
		$saved = '';
		
		for ($i=0; $i<strlen($formula); $i++)
		{
			$current = $formula[$i];
			$next = (isset($formula[$i+1])) ? $formula[$i+1] : FALSE;
			
			//Если число
			if (is_numeric($current)) 
			{
				$num = $current;

				if ($next !== FALSE AND is_numeric($next))
				{
					$num = 	$current.$next;					
				}

				if ($saved)
				{
					//Если цифра - сохраняем с цифрой
					$this->addElement($saved, $num * $offset);
				}

				$saved = '';
			} 
			//Если это первый символ элемента из двух символов
			else if ($this->isUpper($current) AND $next AND $this->isLower($next) AND !is_numeric($next)) 
			{
				if (!empty($saved)) 
				{
					$this->addElement($saved, $offset);
					$saved = '';
				}
				
				//замоминаем элемент из двух символов
				$saved = $current;
			}
			//Если это одиночный либо последний
			else if ($this->isUpper($current) AND (($next AND $this->isUpper($next)) OR !$next))
			{
				if (!empty($saved)) 
				{
					$this->addElement($saved, $offset);
					$saved = '';
				}
				
				$saved = $current;
				
				//если совсем последний элемент, то сохраняем
				if (!$next) 
				{
					$this->addElement($saved, $offset);
					$saved = '';
				}
			}
			//Если второй символ
			else if($this->isLower($current))
			{
				//если это последний элемент или следущее НЕ число или следущая большая
				if (!$next AND (!is_numeric($next) OR $this->isUpper($next)))
				{
					if (!empty($saved)) 
					{
						$this->addElement($saved.$current, $offset);
						$saved = '';
					}
				}
				else
				{
					$saved .= $current; 
				}
				
			}
		}
	}

	private function parseFormula($formula)
	{
		$saved = '';
		$skip = 0;
		for ($i=0; $i<strlen($formula); $i++)
		{
			$current = $formula[$i];

			if ($current == '(')
			{
				if ($saved)
				{
					$this->findElements($saved);
				}

				$saved = '';
			}
			else if ($current == ')')
			{
				$next = (isset($formula[$i+1])) ? $formula[$i+1] : FALSE;
				$nextNext = (isset($formula[$i+2])) ? $formula[$i+2] : FALSE;

				$num = 1;

				if ($next)
				{
					if (is_numeric($next))
					{
						$num = $next;
						$skip = 1;

						if ($nextNext AND is_numeric($nextNext))
						{
							$num .= $next;
							$skip = 2;
						}
					}
				}
					
				$this->findElements($saved, $num);		
				$saved = '';
			}
			else
			{
				if ( ! $skip)
				{
					$saved .= $current;	
				}
				else
				{
					$skip--;
				}			
			}
		}
		
		if ($saved)
		{
			$this->findElements($saved);	
		}
	}
	
	public function getMolarMass() 
	{
		$molarMass = 0;
				
		foreach ($this->elements as $item) 
		{
			$element = $item[0];
			$count 	 = $item[1];
			$molarMass += $this->mendeleevElements[$element] * $count;
		}
		
		return $molarMass;
	}
	
	private function isUpper ($string)
	{
	    return($string === strtoupper($string) ? true : false);
	}
	
	private function isLower ($string)
	{
	    return($string === strtolower($string) ? true : false);
	}

	private function clear($string)
	{
		$string = trim($string);
		$string = strip_tags($string);
		$string = preg_replace('/\s+/', '', $string);

		return $string;
	}
}
?>