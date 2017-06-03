<?php

// Get database info.
require('config.php');

// Returns synonyms for a single word.
function synWord($word, $rand) {
	// Make everything global.
	global $stopwords;
	global $dbhost;
	global $dbuser;
	global $dbpass;
	global $dbname;
	$orig = $word;

	// Connect to database.
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	
	// Remove and remember punctuation.
	$punct = substr($word, -1);
	if ($punct == '?' || $punct == '!' || $punct == '.' || $punct == ',') {
		$word = substr($word,0,-1);
	}
	// Remove and remember capitol letters.
	$capit = 0;
	if (preg_match('/[A-Z]/', substr($word,0,1))) {
		$capit = 1;
		$word = strtolower($word);
	}

	// Escape characters.
	$word = addslashes($word);

	// Don't run if word is stop word.
	if (@!in_array($word, $stopwords)) {

		// Check if synonyms exist.
		$excheck = mysql_result(mysql_query("SELECT count(*) FROM synWords WHERE synonym='$word'"), 0);

		if ($excheck != 0) {
		
			// Loop for each word ID. Words could have multiple meanings.
			$i = 0;
			$stopper = 0;
			
			$query = mysql_query("SELECT word_id FROM synWords WHERE synonym='".$word."'");
			while (!$stopper) {
				// Surpressed error here. Related to unable to grab results.
				$synum = @mysql_result($query, $i);
		
				if (!$synum) {
					$stopper = 1;
				}
				else {
					$synums[] = $synum;
				}
				
				$i++;
			}
		
			// If synonyms were found, loop through each set.
			if ($synums) {
				foreach ($synums as $numb) {
			
					// Grab synonyms from database.
					$query = "SELECT synonym FROM synWords WHERE WORD_ID='".$numb."'"; 
					$result = mysql_query($query) or die(mysql_error());
					// Place synonyms in array.
					while ($row = mysql_fetch_array($result)) {
						$synonym[] = $row['synonym'];
					}
			
				}			
			}
			else {
				$synonym[0] = $word;
			}
		}
		else {
			$synonym[0] = $word;
		}
		
		// Delete duplicate values from sets.
		$synonym = array_unique($synonym);
		
	}
	
	// Stripo slashes, delete duplicates of original word.
	$word = stripslashes($word);
	if ($synonym) {
		$i = 0;
		foreach ($synonym as $csyn) {
			$synonym[$i] = stripslashes($synonym[$i]);
			
			if ($synonym[$i] == $word) {
				unset ($synonym[$i]);
				$synonym = array_values($synonym);
			}
			$i++;
		}
		
		// Delete emtpy values of word.
		foreach ($synonym as $key => $value) { 
			if($value == "") { 
				unset($synonym[$key]); 
			} 
		} 
		$synonym = array_values($synonym);
	}
	
	// Replace punctuation, if any.
	if ($punct == '?' || $punct == '!' || $punct == '.' || $punct == ',') {
		// Loop to punctuate all synonyms.
		$i = 0;
		if ($synonym) {
			foreach ($synonym as $csyn) {
				$synonym[$i] = $synonym[$i].$punct;
				$i++;
			}
		}
	}
	
	// Replace capitol letter.
	if ($capit == 1) {
		// Loop to cap synonyms.
		$i = 0;
		if ($synonym) {
			foreach ($synonym as $csyn) {
				$synonym[$i] = ucfirst($synonym[$i]);
				$i++;
			}
		}
	}
	
	
	// If random word option is on, select a single word from array, echo results.
	if ($rand) {
		if ($synonym) {
			shuffle($synonym);
			return $synonym[0];
		}
		else {
			return "";
		}
	}
	// If random word option is off.
	else {
		if ($synonym) {
			return $synonym;
		}
		else {
			return "";
		}
	}
	
	// Close database.
	mysql_close($conn);	
}

// Return synonyms for a sentence.
function synSentence($rewriteme, $rand) {
	// Turn original text into array.
	$orig = explode(" ", $rewriteme);
	
	// If random option is on.
	if ($rand) {
		// Loop through each word using original funtion to find synonyms.
		foreach ($orig as $cword) {
			$newsyn = synWord($cword, 1);
			
			// If new synonym was found, add to string.
			if ($newsyn) {
				$recon = $recon.$newsyn." ";
			}
			// If not, add original word to string.
			else {
				$recon = $recon.$cword." ";
			}
		}
		return $recon;
	}
	
	// If random option is off.
	else {
		// Loop through each word using original funtion to find synonyms.
		$i = 0;
		foreach ($orig as $cword) {
			$newsyn = synWord($cword, 0);
			
			$recon[$i][0] = $cword;
			
			// If new synonyms were found, store in array
			if ($newsyn) {
				$c = 1;
				foreach ($newsyn as $ns) {
					$recon[$i][$c] = $ns;
					$c++;
				}
			}
			$i++;
		}
		return $recon;
	}
}

?>