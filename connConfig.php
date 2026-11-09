<?php
/**
 * These are the database login details
 */  
if(!isset($_SESSION))
{
    session_start();
}
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "artofius");    // The database username. 
define("PASSWORD", "aXudP!-0t8jcwWbZ");    // The database password. 
define("DATABASE", "typingtest");    // The database name.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function esc($given){
	$conn=new mysqli(HOST,USER,PASSWORD,DATABASE);
	return mysqli_real_escape_string($conn, $given);
}
function createRadios($radioName,$navi, $arrayOfRadios,$default = 0,$names = array()){
	$radios = "";
	$images = "";
	$shownRadios = ($default == 2 ? '<input type="checkbox" id="checkbox' . $radioName . '">' : '' ) . '<div class="' . $navi . '">';
	$first = true;
	$jsForAuto = "";
	$length = count($arrayOfRadios);
	for($indx = 0; $indx < $length; $indx++){
		$un = $radioName . ($indx+1);
		$radios .= '<input type="radio" name="' . $radioName . '" id="radio' . $un . ($first ? '" checked="checked"' : '"') .  '>';
		$images .= '<div class="slide' . $un . ($first ? ' first' : '') .  '">
						<img src="images/' . $arrayOfRadios[$indx] . '.png" alt=""> 
					</div>';
		switch($default){			
			case 0: $shownRadios .= regularRadios($un, $navi, ($indx+1)); break;
		
			case 1: $shownRadios .= sideMenuRadios($un, $arrayOfRadios[$indx], $names[$indx]); break;

			case 2: $shownRadios .= ($first ? regularCheckBox($radioName) : '' ) . sideMenuRadios($un, $arrayOfRadios[$indx], $names[$indx]); break;
			
		}
		$first = false;
	}
	$shownRadios .= '</div>';
	$jsForAuto = '<script type="text/javascript">
				var counter' . $radioName . ' = 2;
				var ' . $radioName . 'Interval = setInterval(() =>{
				document.getElementById(\'radio' . $radioName . '\' + counter' . $radioName . ').checked = true;
				counter' . $radioName . ' += (counter' . $radioName . ' > ' . ($length-1) . ' ? -' . ($length-1) . ' : 1 );//php this too 
				},5000);
				function ' . $navi . 'Clicked(indexClicked){
					counter' . $radioName . ' = indexClicked;
					clearInterval(' . $radioName . 'Interval);
					' . $radioName . 'Interval = setInterval(() =>{
					document.getElementById(\'radio' . $radioName . '\' + counter' . $radioName . ').checked = true;
					counter' . $radioName . ' += (counter' . $radioName . ' > ' . ($length-1) . ' ? -' . ($length-1) . ' : 1 );//php this too 
					},5000);
				}
				</script>';

	return array($radios, $images, $shownRadios,$jsForAuto);				
}
function regularRadios($un, $navi,$ii){
	return '<label for="radio' . $un . '" class="btn" onclick="' . $navi . 'Clicked(' . ($ii) . ');"></label>';
}
function regularCheckBox($un){
	return '<label for="checkbox' . $un . '" ><span class="glyphicon glyphicon-triangle-left"></span></label>';
}
function sideMenuRadios($un, $img, $name){
	return '<label for="radio' . $un . '" class="itemIn">
			<h2>' . $name . '</h2>
			</label>';
}
function createToken($ui){
	$token2 = hash('sha256',rand(),false); 
    $successful = sqlExecute(sprintf("insert into auth(user1, timestamp1,token1) values('%s',now(),'%s');",esc($ui),esc($token2)));
	$tkn=sqlSelect("select token1 from auth where token1 = '" . $token2 . "'");
	try
	{
		if($successful && (count($tkn) > 0)){
			return $tkn[0][0];
		}
        else{
            echo "Nope";
        }
	}
	catch(Exception $e)
    {
        echo "Something went Wrong during Login";
    }
    return "";
}

function sqlSelect($query){
	$conn=new mysqli(HOST,USER,PASSWORD,DATABASE);	
	if(! $conn)
	{
		die('Connection Failed');
	}
	//$example = sprintf("SELECT * FROM Table1 WHERE field1='%s' AND password='%s'", esc($username), esc($password));
	$result = $conn->query($query);
	$rowIndex = -1;
	while($row = $result->fetch_array(MYSQLI_NUM)){
		++$rowIndex;
		for($a = 0;$a < $conn->field_count;$a++)
		{
			$arrow[$rowIndex][$a] = $row[$a]; 
		}
	}
	$conn->close();
	return ($rowIndex == -1 ? array(): $arrow);
}
function sqlExecute($query){
	$conn=new mysqli(HOST,USER,PASSWORD,DATABASE);	
	if(gettype($query) == "array"){
		if(count($query) == 3){
			if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
			} 
			if ($conn->query($query[0]) === TRUE) {
    			echo $query[1];
    			return true;
			} 
			else {
    			echo $query[2];
    			return false;
			}
		}
		else{
			echo 'Error: sqlExecute is missing some parameter';
		}
	}
	else if(gettype($query) == "string"){
		if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
			} 
			if ($conn->query($query) === TRUE) {
    			return true;
			} 
			else {
    			return false;
			}
	}
	$conn->close();
	return false;
}
function twoToOne($arr){
	$newarr = array();
	foreach($arr as $str)
	{
		$newarr[] = $str[0];
	}
	return $newarr;
}
?>