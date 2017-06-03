<?php

// Get text to be rewritten
$rewriteme = $_POST['rewriteme'];

// Get template.
$template = "template.html";
$fh = fopen($template, 'r');
$temp = fread($fh,filesize("template.html"));
fclose($fh);

// Get config and rewriter functions.
require('text-rewriter.php');

// Rewrite text
$rewritten = synSentence($rewriteme, 0);










// Rewritten sentence
$i = 0;
foreach ($rewritten as $r) {

	// If a synonym was found
	if ($r[1]) {
		$main .= "<span id='".$i."'>".$r[1]."</span> ";
	}
	// If no synonym was found
	else {
		$main .= $r[0]." ";
	}
	
	$i++;
}


$main .= "<br /><br />";




// Dropdown menus
$i = 0;
foreach ($rewritten as $r) {
	// If a synonym was found
	if ($r[1]) {
	
		$main .= "<select onchange='changeWord(".$i.")' id='a".$i."'>";
		
		foreach ($r as $s) {
			$main .= "<option value='".$s."'>".$s."</option>";
		}
	
	
		$main .= "</select> ";
	
	
	
	}
	// If no synonym was found
	else {
		$main .= $r[0]." ";
	}
	
	$i++;
}








// Output page.
$output = str_replace("<!-- text rewriter goes here -->", $main, $temp);
echo $output;

?>