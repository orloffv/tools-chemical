<?
$molarMass = FALSE;

if (isset($_POST['formula']))
{
	include('chemical.php');

	$chemical = new Chemical($_POST['formula']);	
	$molarMass = $chemical->getMolarMass();
}

?>