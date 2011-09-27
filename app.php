<?
$molarMass = FALSE;
$massa = FALSE;
if (isset($_REQUEST['formula']))
{
    //если число
    if (is_numeric($_REQUEST['formula']))
    {
        $molarMass = floatval($_REQUEST['formula']);
    }
    //если формула
    else
    {
        include('chemical.php');

        $chemical = new Chemical($_REQUEST['formula']);    
        $molarMass = $chemical->getMolarMass(); 
    }

    $x = floatval(isset($_REQUEST['x']) ? $_REQUEST['x'] : 0); 
    $y = floatval(isset($_REQUEST['y']) ? $_REQUEST['y'] : 0);
    $z = floatval(isset($_REQUEST['z']) ? $_REQUEST['z'] : 0);

    if ($x OR $y OR $z)
    {
        $x = ($x) ? $x : 1;
        $y = ($y) ? $y : 1;
        $z = ($z) ? $z : 1;

        $massa = $molarMass * $x * $y * $z;
    }
}

if (isset($_REQUEST['ajax']))
{
    if ($molarMass)
    {
        echo "<li>
                <span>Молекулярная масса:</span>
                <span>{$molarMass}</span>
            </li>";
    }

    if ($massa)
    {
        echo "<li>
                <span>Масса:</span>
                <span>{$massa}</span>
            </li>";
    }
}

$selectFormula = array
(
    'глюкоза'               => 'C6H12O6',
    'фруктоза'              => 'C6H12O6',
    'рибоза'                => 'C5H10O5',
    'сахароза'              => 'C12H22O11',
    'крахмал'               => 'C6H10O5',
    'целлюлоза'             => 'C6H10O5',   
    'глицин'                => 'NH2CH2COOH',
    'глицерин'              => 'C3H5(OH)3',
    'трис'                  => '(HOCH2)3CNH2',
    'аскорбиновая кислота'  => 'C6H8O6',
    'диурон'                => 'C9H10Cl2N2O',
    'глиоксилат бутила'     => 'C6H10O3',
    'адреналин'             => 'C9H13NO3',
    'ЭДТА'                  => 'C10H16N2O8',
    'MES'                   => 'C6H13NO4S',
);

?>