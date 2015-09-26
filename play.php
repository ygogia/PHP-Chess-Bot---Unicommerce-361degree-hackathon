<?php
$m=explode("|",$_REQUEST['m']);
$file = file_get_contents("board.json");
$board = json_decode($file,true);
$board[$m[0]][$m[1]]="E";
$n=max(array_map('count',$board));
$current_x;
$current_y;
for($i=1; $i<=$n;$i++){
	for($j=1; $j<=$n;$j++)
	{
		if($board[$i][$j]=="C"){
				$current_x=$i;
				$current_y=$j;
		}
		
		else if($board[$i][$j]=="P")
			$board[$i][$j]=="X";
	}
}
function isSafe($x, $y, $board, $n)
{
		if ( $x > 0 && $x <=$n && $y > 0 && $y <=$n)
		{
			if($board[$x][$y]=="O")
				return 1;
		}
		return 0;
}

	$xMove = array( 0, 1, 1, 1, 0, -1,  -1,  -1 );
	$yMove = array(1, 1,  0, -1, -1, -1, 0, +1 );
	$board[$current_x][$current_y]="X";
   $k;
   $next_x;
   $next_y;
   $inner = array();
   $outer = array();
   $innerCount=1;
   for ($k=0; $k<8; $k++)
   {
      $next_x = $current_x + $xMove[$k];
      $next_y = $current_y + $yMove[$k];
      if (isSafe($next_x, $next_y, $board,$n))
      { 
		echo $inner_next_x." ".$inner_next_y."<br>";
		echo $board[$next_x][$next_y]."----<br>";
		if($board[$next_x][$next_y]=="E")		//Checks eneemy in immeediate viciineety 
		{
				$board[$next_x][$next_y]="C";
				$res=$next_x."|".$next_y;
				$array = array("m" => $res);
				echo json_encode($array);
				break;
		}
			$inner_inner_count=0;
			for ($g=0; $g<8; $g++)
			{
				$inner_next_x = $next_x + $xMove[$g];
				$inner_next_y = $next_y + $yMove[$g];
				//echo $inner_next_x." ".$inner_next_y."<br>";
				if (isSafe($inner_next_x, $inner_next_y, $board,$n))
				{
					if($board[$inner_next_x][$inner_next_y]=="E")		//Checks eneemy in oouter viciineety 
						echo "as";
					else
					$inner[$innerCount]=$next_x.",".$next_y.",".++$inner_inner_count;
				}
			}
			$innerCount++;
			/*	
				$board[$next_x][$next_y]="C";
				$res=$next_x."|".$next_y;
				$array = array("m" => $res);
				echo json_encode($array);
				break;
			*/
       }
   }
   print_r($inner);
/* 
$file = fopen("board.json","w") or die("Unable to open File!");
fwrite($file, json_encode($board));
fclose($file);
*/
for($i=1; $i<=$n;$i++){
	for($j=1; $j<=$n;$j++)
	{
			echo $board[$i][$j];
	}
	echo "<br>";
}
?>