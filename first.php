<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Number to word coversion</title>

<style>
body{
	background-image: url("https://s-media-cache-ak0.pinimg.com/originals/4c/44/ff/4c44ffb3128ea2386e94675af604a8e4.jpg");
	padding-top:250px
	padding-bottom:250px;
	padding-right:250px;
	padding-left:250px;
	
	color:white ;
	text-align:center;	
	}	
	
input[type=text] {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: none;
    border-bottom: 1.60px solid white ; 
}
	
button[type='submit'] {
	display: block;
	color:green;
 text-align: center;
}
.button {
    background-color: #4CAF50;
    border: none;
    color:red;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
	cursor: pointer;

}
.color{
	font-size:20px;
	color:white ;
    padding-top: 50px;
    padding-right: 30px;
    padding-bottom: 50px;
    padding-left: 80px;
	font-weight: bold;
	
	}
p.solid {
border-style: solid;
	border-width: 2px;
	}
	
p.test {
    width: 11em; 
    border: 1px solid white;
    word-wrap: break-word;
}
	
</style>
</head>

<body>
<p class ="test">
<form method="post" action=" " >
<label>Enter a Number:</label>
<input type="text" name="num" placeholder="Enter a number"/></br></br>
	<div class="button">
	<button type="submit" class="submit">Submit</button>
	</div>
</p>
</form>
</body>
</html>



<?php
$num = $_POST['num'];
echo "<div class='color'>Final No:</br>".trim($num)."</div>";
echo '<center><h2>output In Words</h2>'.ucwords(convertNumber($num))."</center>";





function convertNumber($num)
{
list($num, $dec) = explode(".", $num);

$output = "";

if($num{0} == "-")
{
$output = "negative ";
$num = ltrim($num, "-");
}
else if($num{0} == "+")
{
$output = "positive ";
$num = ltrim($num, "+");
}

if($num{0} == "0")
{
$output .= "zero";
}
else
{
$num = str_pad($num, 36, "0", STR_PAD_LEFT);
$group = rtrim(chunk_split($num, 3, " "), " ");
$groups = explode(" ", $group);

$groups2 = array();
foreach($groups as $g) $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});

for($z = 0; $z < count($groups2); $z++)
{
if($groups2[$z] != "")
{
$output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
&& $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");
}
}

$output = rtrim($output, ", ");
}

if($dec > 0)
{
$output .= " point";
for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec{$i});
}

return $output;
}

function convertGroup($index)
{
switch($index)
{
case 11: return " decillion";
case 10: return " nonillion";
case 9: return " octillion";
case 8: return " septillion";
case 7: return " sextillion";
case 6: return " quintrillion";
case 5: return " quadrillion";
case 4: return " trillion";
case 3: return " billion";
case 2: return " million";
case 1: return " thousand";
case 0: return "";
}
}

function convertThreeDigit($dig1, $dig2, $dig3)
{
$output = "";

if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";

if($dig1 != "0")
{
$output .= convertDigit($dig1)." hundred";
if($dig2 != "0" || $dig3 != "0") $output .= " and ";
}

if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);
else if($dig3 != "0") $output .= convertDigit($dig3);

return $output;
}

function convertTwoDigit($dig1, $dig2)
{
if($dig2 == "0")
{
switch($dig1)
{
case "1": return "ten";
case "2": return "twenty";
case "3": return "thirty";
case "4": return "forty";
case "5": return "fifty";
case "6": return "sixty";
case "7": return "seventy";
case "8": return "eighty";
case "9": return "ninety";
}
}
else if($dig1 == "1")
{
switch($dig2)
{
case "1": return "eleven";
case "2": return "twelve";
case "3": return "thirteen";
case "4": return "fourteen";
case "5": return "fifteen";
case "6": return "sixteen";
case "7": return "seventeen";
case "8": return "eighteen";
case "9": return "nineteen";
}
}
else
{
$temp = convertDigit($dig2);
switch($dig1)
{
case "2": return "twenty-$temp";
case "3": return "thirty-$temp";
case "4": return "forty-$temp";
case "5": return "fifty-$temp";
case "6": return "sixty-$temp";
case "7": return "seventy-$temp";
case "8": return "eighty-$temp";
case "9": return "ninety-$temp";
}
}
}

function convertDigit($digit)
{
switch($digit)
{
case "0": return "zero";
case "1": return "one";
case "2": return "two";
case "3": return "three";
case "4": return "four";
case "5": return "five";
case "6": return "six";
case "7": return "seven";
case "8": return "eight";
case "9": return "nine";
}
}

?>
