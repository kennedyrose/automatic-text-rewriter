<?php
$username = $_POST['username'];
$password = $_POST['password'];
$databasename = $_POST['databasename'];
$host = $_POST['host'];
if ($username || $password || $databasename || $host) {
	$trying = 1;
}
?><html>
  <head>
    <title>Automatic Text Rewriter Installer</title>
    <style type="text/css">
      body {
      	margin:20px;
      	font-family:verdana;
      	color:#333333;
      }
      p {
      	margin-top:30px;
      }
      .error {
      	color:red;
      }
    </style>
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" border="0" width="428" align="center">
      <tr>
        <td>
          <img src="logo.png" />
<?php

// Display second page.
if ($username && $password && $databasename && $host) {

	// Create config file.
	$ourFileName = "config.php";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	fclose($ourFileHandle);
	
	// Set permissions
	chmod("config.php", 0644);
	
	// Refill config.php
	$file = "config.php"; 
	$handle = fopen($file, 'w');
	
	$data = "<?php

// The database info for the list of synonyms included in this package.

\$dbuser = '".$username."'; // Fill in the database user's name associated with the database.
\$dbpass = '".$password."'; // Fill in the database user's password associated with the database.
\$dbhost = '".$host."'; // Change to your host's name or leave if localhost.
\$dbname = '".$databasename."'; // Chagne this to the database name. Or leave the same if using the same name as the file in this package.


// Array for ignored words. These words will NOT be changed by the functions synWord() and synSentence().
\$stopwords = array(
	\"a\",
	\"about\",
	\"above\",
	\"above\",
	\"across\",
	\"after\",
	\"afterwards\",
	\"again\",
	\"against\",
	\"all\",
	\"almost\",
	\"alone\",
	\"along\",
	\"already\",
	\"also\",
	\"although\",
	\"always\",
	\"am\",
	\"among\",
	\"amongst\",
	\"amoungst\",
	\"amount\",
	\"an\",
	\"and\",
	\"another\",
	\"any\",
	\"anyhow\",
	\"anyone\",
	\"anything\",
	\"anyway\",
	\"anywhere\",
	\"are\",
	\"around\",
	\"as\",
	\"at\",
	\"back\",
	\"be\",
	\"became\",
	\"because\",
	\"become\",
	\"becomes\",
	\"becoming\",
	\"been\",
	\"before\",
	\"beforehand\",
	\"behind\",
	\"being\",
	\"below\",
	\"beside\",
	\"besides\",
	\"between\",
	\"beyond\",
	\"bill\",
	\"both\",
	\"bottom\",
	\"but\",
	\"by\",
	\"call\",
	\"can\",
	\"cannot\",
	\"cant\",
	\"co\",
	\"con\",
	\"could\",
	\"couldnt\",
	\"cry\",
	\"de\",
	\"describe\",
	\"detail\",
	\"do\",
	\"done\",
	\"down\",
	\"due\",
	\"during\",
	\"each\",
	\"eg\",
	\"eight\",
	\"either\",
	\"eleven\",
	\"else\",
	\"elsewhere\",
	\"empty\",
	\"enough\",
	\"etc\",
	\"even\",
	\"ever\",
	\"every\",
	\"everyone\",
	\"everything\",
	\"everywhere\",
	\"except\",
	\"few\",
	\"fifteen\",
	\"fify\",
	\"fill\",
	\"find\",
	\"fire\",
	\"first\",
	\"five\",
	\"for\",
	\"former\",
	\"formerly\",
	\"forty\",
	\"found\",
	\"four\",
	\"from\",
	\"front\",
	\"full\",
	\"further\",
	\"get\",
	\"give\",
	\"go\",
	\"had\",
	\"has\",
	\"hasnt\",
	\"have\",
	\"he\",
	\"hence\",
	\"her\",
	\"here\",
	\"hereafter\",
	\"hereby\",
	\"herein\",
	\"hereupon\",
	\"hers\",
	\"herself\",
	\"him\",
	\"himself\",
	\"his\",
	\"how\",
	\"however\",
	\"hundred\",
	\"ie\",
	\"if\",
	\"in\",
	\"inc\",
	\"indeed\",
	\"interest\",
	\"into\",
	\"is\",
	\"it\",
	\"its\",
	\"itself\",
	\"keep\",
	\"last\",
	\"latter\",
	\"latterly\",
	\"least\",
	\"less\",
	\"ltd\",
	\"made\",
	\"many\",
	\"may\",
	\"me\",
	\"meanwhile\",
	\"might\",
	\"mill\",
	\"mine\",
	\"more\",
	\"moreover\",
	\"most\",
	\"mostly\",
	\"move\",
	\"much\",
	\"must\",
	\"my\",
	\"myself\",
	\"name\",
	\"namely\",
	\"neither\",
	\"never\",
	\"nevertheless\",
	\"next\",
	\"nine\",
	\"no\",
	\"nobody\",
	\"none\",
	\"noone\",
	\"nor\",
	\"not\",
	\"nothing\",
	\"now\",
	\"nowhere\",
	\"of\",
	\"off\",
	\"often\",
	\"on\",
	\"once\",
	\"one\",
	\"only\",
	\"onto\",
	\"or\",
	\"other\",
	\"others\",
	\"otherwise\",
	\"our\",
	\"ours\",
	\"ourselves\",
	\"out\",
	\"over\",
	\"own\",
	\"part\",
	\"per\",
	\"perhaps\",
	\"please\",
	\"put\",
	\"rather\",
	\"re\",
	\"same\",
	\"see\",
	\"seem\",
	\"seemed\",
	\"seeming\",
	\"seems\",
	\"serious\",
	\"several\",
	\"she\",
	\"should\",
	\"show\",
	\"side\",
	\"since\",
	\"sincere\",
	\"six\",
	\"sixty\",
	\"so\",
	\"some\",
	\"somehow\",
	\"someone\",
	\"something\",
	\"sometime\",
	\"sometimes\",
	\"somewhere\",
	\"still\",
	\"such\",
	\"system\",
	\"take\",
	\"ten\",
	\"than\",
	\"that\",
	\"the\",
	\"their\",
	\"them\",
	\"themselves\",
	\"then\",
	\"thence\",
	\"there\",
	\"thereafter\",
	\"thereby\",
	\"therefore\",
	\"therein\",
	\"thereupon\",
	\"these\",
	\"they\",
	\"thickv\",
	\"thin\",
	\"third\",
	\"this\",
	\"those\",
	\"though\",
	\"three\",
	\"through\",
	\"throughout\",
	\"thru\",
	\"thus\",
	\"to\",
	\"together\",
	\"too\",
	\"top\",
	\"toward\",
	\"towards\",
	\"twelve\",
	\"twenty\",
	\"two\",
	\"un\",
	\"under\",
	\"until\",
	\"up\",
	\"upon\",
	\"us\",
	\"very\",
	\"via\",
	\"was\",
	\"we\",
	\"well\",
	\"were\",
	\"what\",
	\"whatever\",
	\"when\",
	\"whence\",
	\"whenever\",
	\"where\",
	\"whereafter\",
	\"whereas\",
	\"whereby\",
	\"wherein\",
	\"whereupon\",
	\"wherever\",
	\"whether\",
	\"which\",
	\"while\",
	\"whither\",
	\"who\",
	\"whoever\",
	\"whole\",
	\"whom\",
	\"whose\",
	\"why\",
	\"will\",
	\"with\",
	\"within\",
	\"without\",
	\"would\",
	\"yet\",
	\"you\",
	\"your\",
	\"yours\",
	\"yourself\",
	\"yourselves\",
	\"the\"
);

?>";
	fwrite($handle, $data); 
	
?>

          <p>You're done! If all the information you submitted was correct, you should see your the script in action at <a href="index.php">this page</a>. You can edit the "template.html" if you want to edit the way your site looks.</p>



<?php
	

} // End of second page.
// Display first page.
else {
	// Error list.
	if ($trying && !$username) {
		echo "<p class=\"error\">You must fill out the \"Database username\" field.</p>";
	}
	if ($trying && !$password) {
		echo "<p class=\"error\">You must fill out the \"Database password\" field.</p>";
	}
	if ($trying && !$databasename) {
		echo "<p class=\"error\">You must fill out the \"Database name\" field.</p>";
	}
	if ($trying && !$host) {
		echo "<p class=\"error\">You must fill out the \"Host\" field.</p>";
	}
?>
        
          <form action="install.php" method="post">
            <table cellpadding="0" cellspacing="10" border="0" align="center">
              <tr>
                <td>Database username:&nbsp;</td>
                <td><input type="text" name="username" /></td>
              </tr>
                <td>Database password:&nbsp;</td>
                <td><input type="text" name="password" /></td>
              </tr>
              </tr>
                <td>Database name:&nbsp;</td>
                <td><input type="text" name="databasename" value="words_db" /></td>
              </tr>
              </tr>
                <td>Database host:&nbsp;</td>
                <td><input type="text" name="host" value="localhost" /></td>
              </tr>
              <tr align="center">
                <td colspan="2" ><input type="submit" value="Submit" /></td>
              </tr>
            </table>
          </form>
      
      
        </td>
      </tr>
    </table>

<?php
} // End of first page.
?>




    <br /><br />
    <div align="center">Text Rewriter Script &copy; 2012 <a href="http://www.shakesbot.com/">Kennedy Rose</a>.
  </body>
</html>