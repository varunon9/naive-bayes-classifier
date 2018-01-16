<?php

    /**
     * mysql> create database naiveBayes;
     * mysql> use naiveBayes;
     * mysql> create table trainingSet (S_NO integer primary key auto_increment, document text, category varchar(255));
     * mysql> create table wordFrequency (S_NO integer primary key auto_increment, word varchar(255), count integer, category varchar(255));
     */

    require_once('NaiveBayesClassifier.php');

    $classifier = new NaiveBayesClassifier();
    $spam = Category::$SPAM;
    $ham = Category::$HAM;

    $classifier -> train('Have a pleasurable stay! Get up to 30% off + Flat 20% Cashback on Oyo Room' . 
            ' bookings done via Paytm', $spam);
    $classifier -> train('Lets Talk Fashion! Get flat 40% Cashback on Backpacks, Watches, Perfumes,' .
            ' Sunglasses & more', $spam);

    $classifier -> train('Opportunity with Product firm for Fullstack | Backend | Frontend- Bangalore', $ham);
    $classifier -> train('Javascript Developer, Fullstack Developer in Bangalore- Urgent Requirement', $ham);

    $category = $classifier -> classify('Scan Paytm QR Code to Pay & Win 100% Cashback');
    echo $category;
    
    $category = $classifier -> classify('Re: Applying for Fullstack Developer');
    echo $category;

?>