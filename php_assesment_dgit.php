<?php
// 4.1 ONLY ALPHANUMERIC CHARACTERS
echo "<br/>1. +++++++++++++++ Filter Alphanumeric characters  ++++++++++++++++++<br/>";

echo "<p>In the sentence: <br/>";

$s = "What is the name of that book about 1000 great résumé tips__?";

echo $s;

echo "<br/><br/>calling function <i>onlyAlphaNumeric() </i><br/>";

//$result = preg_replace("/[^a-zA-Z0-9]+/", "", $s);


function onlyAlphaNumeric($anyString){

	$result = preg_replace("/[^a-zA-Z0-9]+/", "", $anyString);
	return $result;
}

echo onlyAlphaNumeric($s);
echo "</p>";


// 4.2 CHECK IF IT IS CONTAINED
echo "<br/>2. +++++++++++++++ Check if a word is contained in a sentence  ++++++++++++++++++<br/>";

$needle = "apple";
$haystack = "Apple makes functional computers.";
echo "<p>Check if the word '".$needle."' is contained in '".$haystack."' <br/>";

function isContainedIn($contained, $container){
if (stripos($container, $contained) !== false) {echo "True";} else {echo "False";};
}

echo isContainedIn($needle,$haystack);
echo "</p>";


// 4.3  RECURSIVE FUNCTION

echo "<br/>3. +++++++++++++++++ Recursive function to validate group_ids  ++++++++++++++++++++<br/>";
 


function validate_group_ids($group_ids ='') {

	if (is_array($group_ids)) { 

		foreach ($group_ids as $key ) {
			
			if(is_numeric($key)){return true;}# code...
		}

	}
	
	elseif (is_numeric($group_ids)) { return true; }
	elseif (is_string($group_ids)) { echo $group_ids ." ";}
 
}

$my_groups = [152, 1235, array(1531, 'foo', 331), 'bar']; 


$valid = array_filter($my_groups, 'validate_group_ids');

var_dump($valid);


//var_dump($my_groups);
validate_group_ids($my_groups);


echo "<br/>";
echo "<br/>";
 

// 4.4  ITERATE TROUGH ARRAY AND DISPLAY EMPLY USERNAMES 
echo "<br/>4. +++++++++++++++++ Show only the entries without username ++++++++++++++++++++<br/>";



$user_accounts = [
				["firstname" => "Sidney", "lastname" => "Blooth", "username" => "sbooth", "email" => "sbooth@email.com", "telephone" => "613-555-1235 x303"],
				["firstname" => "Amy", "lastname" => "Anderson", "username" => "", "email" => "aanderson@email.com", "telephone" => "613-555-1235 x304"],
				["firstname" => "Stew", "lastname" => "Johnson", "username" => "sjohnson", "email" => "sjohnson@email.com", "telephone" => "613-555-1235 x305"],
				["firstname" => "Gill", "lastname" => "Sans", "username" => "gsans", "email" => "gsans@email.com", "telephone" => "613-555-1235 x306"],
				["firstname" => "Anne", "lastname" => "LeMont", "username" => "", "email" => "alemont@email.com", "telephone" => "613-555-1235 x307"],
				["firstname" => "Doug", "lastname" => "Anderson", "username" => "danderson", "email" => "danderson@email.com", "telephone" => "613-555-1235 x308"]
];

$filtered = array_filter($user_accounts, 'filter');
$rowcount = count(filtered);

function filter($data){
	if(is_array($data)){
		for ($i = 0; $i <= count($data[$i]); $i++) {
   			if ($data['username'] == "") { 
   				return 	true;
   			}
		}
	}
}

//var_dump($filtered[4]);
 
echo "<table id='tblstudents'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Username</th>
<th>E-Mail Address</th>
<th>Telephone</th>
</tr>";
      
          	
			for ($j = 0; $j <= count($user_accounts); $j++)
			{
			 $firstname = $filtered[$j]["firstname"];
			 $lastname = $filtered[$j]["lastname"];
			 $username = $filtered[$j]["username"];
			 $email = $filtered[$j]["email"];
			 $telephone = $filtered[$j]["telephone"];
			
			 echo "<tr><td>".$firstname."</td><td> ".$lastname."</td><td> ".$username." </td><td> ".$email."</td><td> ".$telephone."</td></tr>"; 
			 }
			 
			

    
echo "</table> ";


// 4.5 PROPERLY DOCUMENT FUNCTIONS


 $row = array_values($user_accounts);


 for ($j = 0;  $j <= count($user_accounts); $j++ ){

 	echo $user_accounts[$j];

 }





//var_dump($row);



$user_accounts = [
				["firstname" => "Sidney", "lastname" => "Blooth", "username" => "sbooth", "email" => "sbooth@email.com", "telephone" => "613-555-1235 x303"],
				["firstname" => "Amy", "lastname" => "Anderson", "username" => "", "email" => "aanderson@email.com", "telephone" => "613-555-1235 x304"],
				["firstname" => "Stew", "lastname" => "Johnson", "username" => "sjohnson", "email" => "sjohnson@email.com", "telephone" => "613-555-1235 x305"],
				["firstname" => "Gill", "lastname" => "Sans", "username" => "gsans", "email" => "gsans@email.com", "telephone" => "613-555-1235 x306"],
				["firstname" => "Anne", "lastname" => "LeMont", "username" => "", "email" => "alemont@email.com", "telephone" => "613-555-1235 x307"],
				["firstname" => "Doug", "lastname" => "Anderson", "username" => "danderson", "email" => "danderson@email.com", "telephone" => "613-555-1235 x308"]
];





echo "</MMOOOOOCCCCC> ";


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Problem 4) PHP: Regular Expressions</title>

	<link rel="stylesheet" href="../stylesheet.css" type="text/css" />
</head>
<body>
<div id="navigator">
	Problem 4) PHP: General Skills
</div>

<h1>Problem 4) PHP: General Skills</h1>

<h3>Problems:</h3>
<ol>
	<li>Write a PHP function that returns <strong>only</strong> alphanumeric characters from the provided string. Demonstrate its usage.</li>
	<li>Write a PHP function that returns &quot;yes&quot; or &quot;no&quot; depending if the word <strong>apple</strong> (case insensitive) appears in the provided string. Demonstrate its usage.</li>
	<li>Write a <strong>recursive</strong> PHP function that accepts an array or an integer as its first attribute. If the passed value is not an array, check if it is an integer. If it is not an integer, echo the string. If the passed value is an array, then continue with the recursion. <em>Be careful of infinte loops!</em>
	<li>Itierate through the provided multi-dimensional $userAccounts array and display the two rows that do not have usernames.</li>
</ol> 

<h3>Bonus (Optional):</h3>
<ol>
	<li>Document your functions in PHPDocumentor format.</li>
</ol>

<h3 class="solution">My Solutions:</h3>

<!-- Insert your solutions here. -->

<h4>Solution 1</h4>
<?php
 
echo "<p>In the sentence: <br/>";

$s = "What is the name of that book about 1000 great résumé tips?";
echo $s;
echo "</p>";

echo "<p>Calling function <i>onlyAlphaNumeric()</i> </br>";

//$result = preg_replace("/[^a-zA-Z0-9]+/", "", $s);

	
	/**
	*
	*@return string with only alphanumeric values
	*
	**/
function onlyAlphaNumeric($anyString){
 
	$result = preg_replace("/[^a-zA-Z0-9]+/", "", $anyString);
	return $result;
}

echo onlyAlphaNumeric($s);

echo "</p>";
?>

<h4>Solution 2</h4>
<?php

$needle = "apple";
$haystack = "Apple makes functional computers.";
echo "<p>Check if the word '".$needle."' is contained in '".$haystack."' <br/>";


	/**
	* Checks if a string is contained into another
	* 
	* @return 'yes' || 'no' 
	* @param $contained the string to be loookig for
	* @param $container the string in wich it will look for
	**/
function isContainedIn($contained, $container){
if (stripos($container, $contained) !== false) {echo "True";} else {echo "False";};
}

echo isContainedIn($needle,$haystack);
echo "</p>";

?>

<h4>Solution 3</h4>
<p>Implement a recursive function that takes array or integer</p>
<?php

	/**
	* Validate the imput of an array of numbers
	* 
	* @param $group_ids array || int
	* @return int || array
	*
	**/

function validate_group_ids($group_ids ='') {

	if (is_integer($group_ids)) { 
 	
		return true;

	}
	else if (is_string($group_ids)){
		
		echo $group_ids;
		} else if (is_array($group_ids)){
			
			validate_group_ids($group_ids);
			} 
	
	elseif (is_numeric($group_ids)) { return true; }
	elseif (is_string($group_ids)) { echo $group_ids ." ";}
 
}

$my_groups = [152, 1235, array(1531, 'foo', 331), 'bar']; 

$valid = array_filter($my_groups, 'validate_group_ids');

var_dump($valid);
 ?>