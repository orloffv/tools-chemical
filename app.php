<?
$molarMass = FALSE;
$massa = FALSE;
if (isset($_POST['formula']))
{
	//если число
	if (is_numeric($_POST['formula']))
	{
		$molarMass = floatval($_POST['formula']);
	}
	//если формула
	else
	{
		include('chemical.php');

		$chemical = new Chemical($_POST['formula']);	
		$molarMass = $chemical->getMolarMass();	
	}

	$x = floatval($_POST['x']);	
	$y = floatval($_POST['y']);
	$z = floatval($_POST['z']);

	if ($x OR $y OR $z)
	{
		$x = ($x) ? $x : 1;
		$y = ($y) ? $y : 1;
		$z = ($z) ? $z : 1;

		$massa = $molarMass * $x * $y * $z;
	}
}

$selectFormula = array
(
	'глюкоза' 				=> 'C6H12O6',
	'фруктоза' 				=> 'C6H12O6',
	'рибоза' 				=> 'C5H10O5',
	'сахароза' 				=> 'C12H22O11',
	'крахмал' 				=> 'C6H10O5',
	'целлюлоза' 			=> 'C6H10O5',	
	'глицин' 				=> 'NH2CH2COOH',
	'глицерин'  			=> 'C3H5(OH)3',
	'трис' 					=> '(HOCH2)3CNH2',
	'аскорбиновая кислота'  => 'C6H8O6',
	'диурон'  				=> 'C9H10Cl2N2O',
	'глиоксилат бутила'  	=> 'C6H10O3',
	'адреналин'				=> 'C9H13NO3',
	'ЭДТА'					=> 'C10H16N2O8',
	'MES'					=> 'C6H13NO4S',
);

?>