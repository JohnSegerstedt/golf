<?php session_start();


// if($_SESSION['p1'] = null){

//hämtar alla par från par.txt
$partext = file_GET_contents('par.txt');
$par = explode("-", $partext);

//$max + hålets par = max slag på ett hål 
$_SESSION['max'] = $par[0];

//sparar par som SESSION
$u = 1;
while($u < 19){
$_SESSION['p'.$u.''] = $par["$u"];
$u++;
}

//skapar nullade variablar som eventuellt sätts senare
$set = null;
$newSet = null;
$pset = null;
$antal = null;
$s1 = null;
$s2 = null;
$s3 = null;
$s4 = null;
$s5 = null;
$s6 = null;


//hämta variablar som bestämmer vilket hål
if(isset($_GET['st'])){$set = $_GET['st'];}
if(isset($_GET['newSet'])){$newSet= $_GET['newSet'];}
if(isset($_GET['pset'])){$pset = $_GET['pset'];}


if($newSet != null){
$set = $newSet;}else{
if($pset < 18 and $pset != null){
$set = $pset+1;}
}

/*
echo "newSet";
echo $newSet;
echo "<br>";
echo "pset";
echo $pset;
echo "<br>";
echo "set";
echo $set;
echo "<br>";
*/

?>
<!DOCTYPE html>
<html>
<head>
<title>Scorekort</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset = "utf-8">
<link rel = "stylesheet" type = "text/css" href = "score.css" media = "all">
</head>


<?php

//"Tillbaka"
if(isset($_GET['start'])){
if($_GET['start'] != null){
session_destroy();}}


//Hämtar antal spelare från första form
if(isset($_GET['antal'])){
if($_GET['antal'] != null){
$_SESSION['antal'] = $_GET['antal'];}}


//Skapar antal spelare som en variabel
if(isset($_SESSION['antal'])){
if($_SESSION['antal'] != null){
$antal = $_SESSION['antal'];}}


//Hämtar alla namnen från SESSION
if(isset($_SESSION['s1'])){
	$int = 1;
	while(isset($_SESSION['s'.$int])){
	${"s".$int} = $_SESSION['s'.$int];
	$int++;
	}
}


//Hämtar och sparar alla namnen från form
if(isset($_GET['s1'])){
	$int = 1;
	while(isset($_GET['s'.$int])){
	${"s".$int} = $_GET['s'.$int];
	$_SESSION['s'.$int] = $_GET['s'.$int];
	$int++;
	}
}


//Skapar hålens resultatarray:er
if(!isset($_SESSION['ar1'])){
$_SESSION['ar1'] = array();
$_SESSION['ar2'] = array();
$_SESSION['ar3'] = array();
$_SESSION['ar4'] = array();
$_SESSION['ar5'] = array();
$_SESSION['ar6'] = array();}

//Sparar hålets resultat i SESSION
if(isset($_GET['n1'])){if($_GET['n1'] != null){$_SESSION['ar1'][$pset] = $_GET['n1'];}}
if(isset($_GET['n2'])){if($_GET['n2'] != null){$_SESSION['ar2'][$pset] = $_GET['n2'];}}
if(isset($_GET['n3'])){if($_GET['n3'] != null){$_SESSION['ar3'][$pset] = $_GET['n3'];}}
if(isset($_GET['n4'])){if($_GET['n4'] != null){$_SESSION['ar4'][$pset] = $_GET['n4'];}}
if(isset($_GET['n5'])){if($_GET['n5'] != null){$_SESSION['ar5'][$pset] = $_GET['n5'];}}
if(isset($_GET['n6'])){if($_GET['n6'] != null){$_SESSION['ar6'][$pset] = $_GET['n6'];}}

//antal
echo "antal = ";
echo $antal;
if($antal == null){echo " null";}
echo "<br>";

//s1
echo "s1 = ";
echo $s1;
if($s1 == null){echo " null";}
echo "<br>";


//set
echo "set = ";
if(isset($set)){
	if($set != null){
		echo $set;
	}else{
		if($set == null){
			echo " null";}}
}else{
	echo "not set";}
echo "<br>";


//SESSION_s1
echo "_SESSION['s1'] = ";
if(isset($_SESSION['s1'])){
	if($_SESSION['s1'] != null){
		echo $_SESSION['s1'];
	}else{
		if($_SESSION['s1'] == null){
			echo " null";}}
}else{
	echo "not set";}
echo "<br>";

if($antal  == null && $s1 == null){ ?>

<body>
	<div id = "wrapper1">
	<div id = "wrapper2">
	<img src = "logga.png"><br><br>

	<!-- Formen för antal spelare -->
	<form action = "score.php" method="GET">
	<div class="hyfsat">Antal spelare:</div><br>
	<input list="antalspelare" name="antal" placeholder="1-6">
		<datalist id="antalspelare">
			<option value="1">
			<option value="2">
			<option value="3">
			<option value="4">
			<option value="5">
			<option value="6">
	  </datalist>

	<div id = "submit">
	<input type = "submit" value = "Fortsätt">
	</div>
	</form>
	</div>
	</div>
</body>

<?php }else if(isset($antal) && $antal != null && $s1 == null){

//Sparar antal spelare från Form till SESSION
$_SESSION['antal'] = $antal; ?>

<body>
	<div id = "wrapper1">
	<div id = "wrapper2">
	<div id = "logga"><img src = "logga.png"></div><br>

	<!-- Form för spelarnas namn -->
	<form action = "score.php" method="GET">
		<div class="hyfsat">Spelarnas namn:</div><br>
		<?php $n = 0;
		while($n<$antal){
		$n++;?>
		<input name="s<?php echo "$n"; ?>" placeholder="Spelare <?php echo "$n"; ?>">
		<?php } ?>

	<div id = "submit">
	<input type = "submit" value = "Fortsätt">
	</div>
	</form>
	<form action = "score.php" method="GET">
	<input type = "hidden" name = "start" value = "start">
	<input type = "submit" value = "Tillbaka">
	</div>
	</div>
</body>


<?php
}else if($antal  != null && $s1 != null){
?>

<body>
<div id = "wrapper3">
<div id = "left">
<?php $k = 1; while($k<19){ $s = $k;?>

<?php
//Hålknappen för aktivt hål
if($set == $k){?>
<button id = "<?php echo "$k"; ?>" class = "button" style = "background-color: #990000; border: inset;" onclick = "location.href='score.php?st=<?php echo "$s"; ?>'"><?php echo "$k"; ?></button>

<?php }else{ ?>
<!-- Hålknapparna i sidan -->
<button id = "<?php echo "$k"; ?>" class = "button" onclick = "location.href='score.php?st=<?php echo "$s"; ?>'"><?php echo "$k"; ?></button>

<?php } $k++;} ?>

</div>

<div id = "top"><img src = "logga.png"></div>
<div id = "right">
	
	<b><?php if($set == null){
	echo "Välj ett hål.";
	echo "</b><br><br><br>";
	echo 'Maxslagen på varje hål är hålets par + '.$_SESSION['max'].' vilket beräknas automatiskt när rundan avslutas.';
	echo "<br><br>";
	echo 'Klicka på "Avsluta runda" efter avklarat spel.';
	echo "<br><br>";
	echo 'Klicka på "Tillbaka" ifall du vill tillbaka till startsidan.'; 
	}else{?>

	<!-- Hämtar och skriver ut namn och form för slag -->
	<b><div class="stor"><?php echo "Hål $set";?></div></b>
	<div><?php echo "Par - "; echo $_SESSION['p'.$set.'']; ?></div>
	<?php $t = 0;
	while($t < $antal){
	$t++;
	$namn = $_SESSION['s'.$t.''];?>
	<form  action="score.php?st=<?php echo $set; ?>" method="GET">
	<br></b><div class="medel"><?php echo $namn;?></div>
	<?php if(isset($_SESSION['ar'.$t.''][$set]) && $_SESSION['ar'.$t.''][$set] != null){?>
	<input type="number" name="n<?php echo "$t";?>" value="<?php echo $_SESSION['ar'.$t.''][$set];?>">
	<input type="hidden" name="pset" value="<?php echo "$set";?>">
	<br><?php }else{ ?>
	<input type="number" name="n<?php echo "$t";?>" placeholder="<?php echo "$namn";?>">
	<br><input type="hidden" name="pset" value="<?php echo $set;?>">
	<?php }}?> <br><br>


	<!-- Frammåt/spara- knappen -->
	<?php if($set > 0 & $set < 19){?>
	<input id="knapp" type = "submit" value = "Spara &rArr;">
	<br><br><?php }} ?>
	</form>

	<!-- Föregående hål- knappen -->
	<?php if($set > 1 or $set != null){
	$a = $set;
	if($set > 1)
	{$a = $set-1;}?>
	<form  action="score.php?" method="GET">
	<input type="hidden" name="newSet" value="<?php echo $a;?>">
	<input type="submit" value="&lArr;">
	</form>
	<?php //?st2=<?php echo "$a"; 
	} ?> <br><br>

	<!-- pdf-spara-knapp -->
	<form action = "print.php">
	<input type = "submit" value = "Avsluta runda">
	</form><br><br>
	
	
	<!-- Tillbaka till början- knapp -->
	<form action = "score.php" method="GET">
	<input type = "hidden" name = "start" value = "start">
	<input type = "submit" value = "Tillbaka">
	</form>

</div>
</div>
</body>
<?php
}else{
//Ser man detta har något riktigt illa hänt
echo "Error";
}
?>
</html>