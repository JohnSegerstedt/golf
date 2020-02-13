<?php
session_start();

include('mpdf60/mpdf.php');

$mpdf=new mPDF();
ob_start();
	
// Här skriver du din php-kod och blandar med html.
// du kan även använda style = "" i dina html-element.


$antal = $_SESSION['antal'];

$today = getdate();
$d = $today['mday'];
$m = $today['mon'];
$y = $today['year'];
$date = $y.'-'.$m.'-'.$d;

$titel = "JohnSegerstedtGolf:";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">

	<style>
	</style>

</head>
<body>

<img id="b" src = "logga.png">
<br><br>

<?php
$rset = 1;
$namn = $_SESSION['s'.$rset.''];


while($namn != null){


$p = 1;

while($k < 19){
${'a'.$k} = $_SESSION['ar'.$rset.''][$k];
$k++;
}


$sum = 0;
$g = 1;
while($g < 19){
	$slagg = $_SESSION['ar'.$rset.''][$g];
	$parr = $_SESSION['p'.$g.''];
	$maxx = $_SESSION['max'] + $parr;
	if($slagg > $maxx){
		$sum = $sum + $maxx;}
	else{
		$sum = $sum + $slagg;	
	}
$g++;}


$array1 = $_SESSION['ar'.$rset.''];
$u = 1;
while($u < 19){
if($array1[$u] == null)
{$array1[$u] = 0;}
$u++;
}

ksort($array1);
$array2 = array_slice($array1, 0,9);
$array3 = array_slice($array1, 9,9);

$ar2sum = array_sum($array2);
$ar3sum = array_sum($array3);


?>

<div class="d"><?php echo $namn; ?></div><br>

<table>
  <tr>
	<?php
$h = 1;


if($ar2sum != 0){
	while($h < 10){?>
		<th>Hål: 
		<?php echo $h; ?>
		<span style="color:gray">
		<?php echo " (".$_SESSION['p'.$h.''].")"; ?></span>
		</th>
		<?php $h++;}?>
	</tr><tr>
	<?php	$y = 1; while($y < 10){
		$slag = $_SESSION['ar'.$rset.''][$y];
		$par = $_SESSION['p'.$y.''];
		$max = $_SESSION['max'] + $par;

			if($slag == 1){?><td style="background-color:yellow; color:red"><?php echo "HoleInOne";}
			elseif($slag == $par){?><td style="background-color:SpringGreen;"><?php echo $slag;}
			elseif($slag == $par-1){?><td style="background-color:MediumTurquoise;"><?php echo $slag;}
			elseif($slag == $par-2){?><td style="background-color:CornflowerBlue;"><?php echo $slag;}
			elseif($slag < $par and $slag != null){?><td style="background-color:Navy ; color:white;"><?php echo $slag;}
			elseif($slag > $max){?><td style="background-color:gray; color:white;"><?php echo $max;}
			else{?><td><?php echo $slag;}
		?></td>
	<?php $y++;}}?>
 </tr></table><br>

<table><tr>
	<?php


if($ar3sum != 0){
	$h = 10;
	$y = 10;
	while($h < 19){?>
    <th>Hål:
		<?php echo $h; ?>
		<span style="color:gray">
		<?php echo " (".$_SESSION['p'.$h.''].")"; ?></span>
		</th>
		<?php $h++;}?>
	</tr><tr>
	<?php 	while($y < 19){
		$slag = $_SESSION['ar'.$rset.''][$y];
		$par = $_SESSION['p'.$y.''];
		$max = $_SESSION['max'] + $par;

			if($slag == 1){?><td style="background-color:yellow; color:red"><?php echo "HoleInOne";}
			elseif($slag == $par){?><td style="background-color:SpringGreen;"><?php echo $slag;}
			elseif($slag == $par-1){?><td style="background-color:MediumTurquoise;"><?php echo $slag;}
			elseif($slag == $par-2){?><td style="background-color:CornflowerBlue;"><?php echo $slag;}
			elseif($slag < $par and $slag != null){?><td style="background-color:Navy ; color:white;"><?php echo $slag;}
			elseif($slag > $max){?><td style="background-color:gray; color:white;"><?php echo $max;}
			else{?><td><?php echo $slag;}
		?></td>
	<?php $y++;}}?>
 </tr></table><br>

<div class="e"><?php echo "Tot:   ".$sum."p"; ?></div><br><br>


<?php
$rset++;
$namn = $_SESSION['s'.$rset.''];
} ?>

<div class="cont">
<div class="box 1"></div><div style="color:white">Maxslag</div>
<div class="box 2"></div><div>Par</div>
</div>
<div class="cont">
<div class="box 3"></div><div>Birdie</div>
<div class="box 4"></div><div>Eagle</div>
</div>
<div class="cont">
<div class="box 5"></div><div style="color:white">Albatross</div>
<div class="box 6"></div><div style="color:red">HoleInOne</div>
</div>

<div id="c"><?php echo $date; ?></div>

<?php


//////////////////////////////////////////////////////////////////////////////////////


// Now collect the output buffer into a variable
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$stylesheet = file_get_contents('print.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html, 2);

// Output a PDF file:
$mpdf->Output($titel.$date.'.pdf','D');

exit;			
		


?>