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

	<form method="POST" novalidate="novalidate">
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
					<option value="<?=$formula?>"><?=$name?></option>
				<?php endforeach;?>
			</select>
		</li>
		<li>
			<input type="text" name="formula" title="Формула" value="<?=isset($_POST['formula']) ? $_POST['formula'] : ''?>"/>
		</li>
		<li>
			<input type="number" name="x" title="Объем" value="<?=isset($_POST['x']) ? $_POST['x'] : ''?>"/>
		</li>
		<li>
			<input type="number" name="y" title="N/M" value="<?=isset($_POST['y']) ? $_POST['y'] : ''?>"/>
		</li>
		<li>
			<input type="number" name="z" title="z" value="<?=isset($_POST['z']) ? $_POST['z'] : ''?>"/>
		</li>
	</ul>
	<p>
		<input type="submit" class="green button" value="Отправить">
	</p>
	
	</form>
	<small>
		<p>This iPhone UI Framework kit is licenced under GNU Affero General Public License (<a href="http://www.gnu.org/licenses/agpl.html">GNU AGPL 3</a>)</p>
	</small>

</body>
</html>