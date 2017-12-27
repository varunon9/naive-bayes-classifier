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

    $classifier -> train('Have a pleasurable stay! Get up to 30% off + Flat 20% Cashback on Oyo Room' + 
            ' bookings done via Paytm', $spam);
    $classifier -> train('Lets Talk Fashion! Get flat 40% Cashback on Backpacks, Watches, Perfumes,' + 
            ' Sunglasses & more', $spam);
    $classifier -> train('One Stop Solution for all Electronic Needs! Get up to 64% off on Home Appliances,' + 
            ' Mobiles & more', $spam);
    $classifier -> train('Last Few Hours - Wardrobe Refresh Sale | Minimum 50% off', $spam);
    $classifier -> train('Up to 90% Off on Fashion Clearance Sale', $spam);
    $classifier -> train('Exciting Entertainment 📺 offers with FreeCharge!', $spam);

    $classifier -> train('Tushara sent you a new message', $ham);
    $classifier -> train('Shivanand Yeurkar messaged on your talent card Application Engineer', $ham);
    $classifier -> train('Your 11 job applications are on their way', $ham);
    $classifier -> train('Queries about Remote-Controller-PC application', $ham);
    $classifier -> train('Meeting today at 4:30 PM sharp, Market', $ham);

    $category = $classifier -> classify('Scan Paytm QR Code to Pay & Win 100% Cashback');
    echo $category;
    
    $category = $classifier -> classify('Re: Job Change | Application Engineer');
    echo $category;

?>