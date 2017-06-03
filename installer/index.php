<?php

// Get template.
$template = "template.html";
$fh = fopen($template, 'r');
$temp = fread($fh,filesize("template.html"));
fclose($fh);

// Create main form content.
$content = "<form action=\"rewritten.php\" method=\"post\"><textarea name=\"rewriteme\">Find random synonyms for this text.</textarea><br /><input type=\"submit\" value=\"Rewrite!\" /></form>";

// Output page.
$output = str_replace("<!-- text rewriter goes here -->", $content, $temp);
echo $output;

?>