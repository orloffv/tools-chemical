<?php 
	include('app.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta id="viewport" name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<title>Chemical</title>
	<link rel="stylesheet" href="UiUIKit/stylesheets/iphone.css" />
	<link rel="apple-touch-icon" href="UiUIKit/images/apple-touch-icon.png" />
	<script type="text/javascript">
		function clickclear(thisfield, defaulttext) 
		{
			if (thisfield.value == defaulttext) {
				thisfield.value = "";
			}
		}

		function clickrecall(thisfield, defaulttext) 
		{
			if (thisfield.value == "") {
				thisfield.value = defaulttext;
			}
		}
	</script>
	
	<script type="text/javascript" charset="utf-8">
		window.onload = function() 
		{
		  setTimeout(function(){window.scrollTo(0, 1);}, 100);
		}
	</script>
</head>
<body>
	<h1>Калькулятор молярных масс</h1>

	<form method="POST">
	<ul class="field">
		<?php if ($molarMass):?>
		<li>
			<h3>Молярная масса:</h3>
			<a><?=$molarMass?></a>
		</li>		
		<?php endif;?>
	</ul>
	<ul class="form">
		<li><input type="text" name="formula" value="<?=isset($_POST['formula']) ? $_POST['formula'] : 'Формула'?>" onclick="clickclear(this, 'Формула')" onblur="clickrecall(this,'Формула')"  /></li>
	</ul>
	<p>
		<input type="submit" class="button white" value="Отправить">
	</p>
	
	</form>
	<p>This iPhone UI Framework kit is licenced under GNU Affero General Public License (<a href="http://www.gnu.org/licenses/agpl.html">GNU AGPL 3</a>)</p>

</body>
</html>
