<?php 
#$dbc = @mysqli_connect('localhost', 'itp225', 'ip225');
$dbc = @mysqli_connect('localhost', 'glen', 'nelg]');
mysqli_select_db($dbc, 'mod5');
$q='SELECT * FROM customers';
echo "qry=".$q.";\n";
$r=mysqli_query($dbc, $q);
$j=mysqli_num_rows($r);
echo 'r='.$j."\n";
if ($j > 0) {
	while($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
		echo "{$row['lastname']}, {$row['firstname']}\n";
	}
} else {
	echo "There are no employees of that sort.\n";
}

?>

