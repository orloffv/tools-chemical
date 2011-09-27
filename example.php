<?
require_once ('src/chemical.php');

$chemical = new Chemical('C5H5OH'); 
var_dump($chemical->getMolarMass());
var_dump($chemical->getFoundElements());

/*
    3BeO.Al2O3.6(SiO2) = (BeO)3.Al2O3.6(SiO2)
    (BaH2O)2Mn5O10 = (BaH2O)2Mn5O10
    (KMgCl3).6H2O = (KMgCl3).6H2O   
*/
?>