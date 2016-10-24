<?php
    /*
    * This is the main module. It reads a paragraph from a text file and classify it
    * It interacts with naiveBayes mysql database for training set
    */
    //Reading file called data.txt and generating a string. This file contains paragraph to classify
    $fileName = "data.txt";
    //empty string
    $dataString = "";
    //$lines is an array of lines from data.txt file
    $lines = file($fileName);
    //print_r($lines);
    for ($i = 0; $i < sizeof($lines); $i++) {
    	$dataString .= $lines[$i];
    	$dataString .= " ";
    }
    //echo $dataString;
    //extracting keywords from data
    require 'extractKeywords.php';
    //$dataArray contains array of keywords
    $dataArray = extractKeywords($dataString);
    //print_r($dataArray);
    //including decide module
    require 'decide.php';
    $category = decide($dataArray);
    echo "Data classified as: " . $category;
?>