<?php 
    include('app.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta id="viewport" name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <title>Калькулятор молярных масс</title>
    <link rel="stylesheet" href="UiUIKit/stylesheets/iphone.css" />
    <script src="js/jquery-1.6.4.min.js"></script>
    <script src="js/custom.js"></script>
    <link rel="apple-touch-icon" href="UiUIKit/images/apple-touch-icon.png" />
</head>
<body>
    <h1>Калькулятор</h1>

    <form method="GET" novalidate="novalidate">
    <ul>
        <?php if ($molarMass):?>
        <li>
            <span>Молекулярная масса:</span>
            <span><?=$molarMass?></span>
        </li>       
        <?php endif;?>
        <?php if ($massa):?>
        <li>
            <span>Масса:</span>
            <span><?=$massa?></span>
        </li>       
        <?php endif;?>
    </ul>
    <ul class="form">
        <li>
            <select id="select-formula">
                <option value="">Вещества</option>
                <?php foreach ($selectFormula as $name => $formula):?>
                    <option <?=(isset($_REQUEST['formula']) AND $_REQUEST['formula'] == $formula) ? 'selected=selected' : '';?> value="<?=$formula?>"><?=$name?></option>
                <?php endforeach;?>
            </select>
        </li>
        <li>
            <input type="url" name="formula" placeholder="Формула" title="Формула" value="<?=isset($_REQUEST['formula']) ? $_REQUEST['formula'] : ''?>"/>
        </li>
        <li>
            <input type="number" name="x" placeholder="Объем" title="Объем" value="<?=isset($_REQUEST['x']) ? $_REQUEST['x'] : ''?>"/>
        </li>
        <li>
            <input type="number" name="y" placeholder="N/M" title="N/M" value="<?=isset($_REQUEST['y']) ? $_REQUEST['y'] : ''?>"/>
        </li>
        <li>
            <input type="number" name="z" placeholder="z" title="z" value="<?=isset($_REQUEST['z']) ? $_REQUEST['z'] : ''?>"/>
        </li>
    </ul>
    <p><a href="#" id="submit" class="green button">Отправить</a></p>
    <p><a href="#" id="clear" class="red button">Очистить</a></p>
    
    </form>
    <small>
        <p>App by <a target="_blank" href="http://orloffv.ru">orloffv</a><br>This iPhone UI Framework kit is licenced under GNU Affero General Public License (<a href="http://www.gnu.org/licenses/agpl.html">GNU AGPL 3</a>)</p>
    </small>

</body>
</html>