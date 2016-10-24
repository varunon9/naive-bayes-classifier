<?php
    /**
    * This module takes an array of words as input and return category (spam/ham) after
    * applying Naive Bayes Classifier
    */
    /*
        Naive Bayes Classifier
        p(spam/bodyText) = p(spam) * p(bodyText/spam) / p(bodyText);
        p(ham/bodyText) = p(ham) * p(bodyText/ham) / p(bodyText);
        p(bodyText) is constant so it can be ommitted
        p(spam) = count of words belonging to category spam / total count of words in database
        p(bodyText/spam) = p(word1/spam) * p(word2/spam) * .... p(wordn/spam)
        Laplace smoothing for such cases is usually given by (c+1)/(N+V), where V is the vocabulary size (total no of different words)
        p(word/spam) = no of times word occur in spam / no of all words in spam
        Reference:
        http://stackoverflow.com/questions/9996327/using-a-naive-bayes-classifier-to-classify-tweets-some-problems
    */
    function decide ($bodyTextArray) {
    	$category = "ham";
        require 'db_connect.php';
    	$sql = mysqli_query($conn, "SELECT sum(count) as total FROM trainingSet WHERE  spamOrHam = 'spam' ");
    	$spamCount = mysqli_fetch_assoc($sql);
    	$spamCount = $spamCount['total'];
    	$sql = mysqli_query($conn, "SELECT sum(count) as total FROM trainingSet WHERE  spamOrHam = 'ham' ");
    	$hamCount = mysqli_fetch_assoc($sql);
    	$hamCount = $hamCount['total'];
    	$sql = mysqli_query($conn, "SELECT sum(count) as total FROM trainingSet ");
    	$totalCount = mysqli_fetch_assoc($sql);
    	$totalCount = $totalCount['total'];
    	//p(spam)
    	$pSpam = $spamCount / $totalCount;
    	//p(ham)
    	$pHam = $hamCount / $totalCount;
    	//echo $pSpam." ".$pHam;
    	$bodyTextIsSpam = log($pSpam);
    	foreach($bodyTextArray as $word) {
    		$sql = mysqli_query($conn, "SELECT count as total FROM trainingSet where words = '$word' and spamOrHam = 'spam' ");
    		$wordCount = mysqli_fetch_assoc($sql);
    		$wordCount = $wordCount['total'];
    		$bodyTextIsSpam += log(($wordCount + 1) / ($spamCount + $totalCount));
    	}
    	$bodyTextIsHam = log($pHam);
    	foreach($bodyTextArray as $word) {
    		$sql = mysqli_query($conn, "SELECT count as total FROM trainingSet where words = '$word' and spamOrHam = 'ham' ");
    		$wordCount = mysqli_fetch_assoc($sql);
    		$wordCount = $wordCount['total'];
    		$bodyTextIsHam += log(($wordCount + 1) / ($hamCount + $totalCount));
    	}
    	if($bodyTextIsHam >= $bodyTextIsSpam) {
    		$category = "ham";
    	}
    	else {
    		$category = "spam";
    	}
    	$conn->close();
    	return $category;
    }
?>