<?php
$our = explode("|",$_REQUEST['y']);
$other = explode("|",$_REQUEST['o']);
$n = $_REQUEST['g'];
$board = array();
for($i=1; $i<=$n;$i++)
{	
	for($j=1; $j<=$n;$j++){
		if($our[0]==$i && $our[1]==$j)
		$board[$i][$j]="C";
		else if($other[0]==$i && $other[1]==$j)
		$board[$i][$j]="P";
		else
		$board[$i][$j]="O";
	}
}
$file = fopen("board.json","w") or die("Unable to open File!");
fwrite($file, json_encode($board));
fclose($file);
$array = array("ok" => true);
echo json_encode($array)."<br>";
for($i=1; $i<=$n;$i++){
	for($j=1; $j<=$n;$j++)
	{
			echo $board[$i][$j];
	}
	echo "<br>";
}
?>