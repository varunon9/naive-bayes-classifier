<?php
    /**
    * this module takes a paragraph of text as input and returns an array of keywords.
    */
    function extractKeywords ($data) {
        $stopWords = array('i','a','about','an','and','are','as','at','be','by',
            'com','de','en','for','from','how','in','is','it','la','of','on','or',
            'that','the','this','to','was','what','when','where','who','will','with','und','the','www');
    	//removing all the characters which ar not letters, numbers or space
    	$data = preg_replace("/[^a-zA-Z 0-9]+/", "", $data);
    	//converting to lowercase
    	$data = strtolower($data);
        //an empty array
    	$dataArray = array();
    	//splitting text into array of keywords
        //http://www.w3schools.com/php/func_string_strtok.asp
    	$token =  strtok($data, " ");
    	while ($token !== false) {
    		//excluding elements of length less than 3
    		if(!(strlen($token) <= 2)) {
    			//excluding elements which are present in stopWords array
                //http://www.w3schools.com/php/func_array_in_array.asp
    			if(!(in_array($token, $stopWords))) {
    				array_push($dataArray, $token);
    			}
    		}
	    	$token = strtok(" ");
    	}
    	return $dataArray;
    }
?>