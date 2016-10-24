<?php
    include 'extractKeywords.php';
    $spamMailArray = "";
    $hamMailArray = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	$spamMailArray = extractKeywords($_POST["spam"]);
    	$hamMailArray = extractKeywords($_POST["ham"]);
    	//connecting to database
    	require 'db_connect.php';
    	//echo "spam keywords -><br>";
    	foreach($spamMailArray as $word) {
    		//echo $word." ";
    		$sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE words = '$word' and spamOrHam= 'spam' ");
    		$count=mysqli_fetch_assoc($sql);
    		//echo $count['total'];
    		if($count['total'] == 0) {
    			$sql = mysqli_query($conn, "INSERT into trainingSet values('$word', 'spam', 1)");
    		}
    		else {
    			$sql = mysqli_query($conn, "UPDATE trainingSet set count = count + 1 where words = '$word'");
    		}
    	}
    	if(count($spamMailArray) > 0) {
    		echo "Spam keywords updates successfully";
    	}
    	echo "<br>";
    	//echo "ham keywords -><br>";
    	foreach($hamMailArray as $word) {
    		//echo $word." ";
    		$sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE words = '$word' and spamOrHam= 'ham' ");
    		$count=mysqli_fetch_assoc($sql);
    		//echo $count['total'];
    		if($count['total'] == 0) {
    			$sql = mysqli_query($conn, "INSERT into trainingSet values('$word', 'ham', 1)");
    		}
    		else {
    			$sql = mysqli_query($conn, "UPDATE trainingSet set count = count + 1 where words = '$word'");
    		}
    	}
    	if(count($hamMailArray) > 0) {
    		echo "Ham keywords updates successfully";
    	}
    	//closing connection
    	$conn->close();
    }

?>