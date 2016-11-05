# Naive Bayes Classifier

Implementing Naive Bayes Classification algorithm into PHP to classify given text as ham or spam. This application is based
on LAMP Stack.

### How to use this application-

1. Download and extract zip.
2. To install training set into your mysql database, create a database named naiveBayes
3. Open a terminal (`Ctrl + Alt + T`)
4. Move to folder where you extracted zip folder
    `cd /path/to/folder`
5. type `mysql -u username -p naiveBayes < naiveBayes.sql` and enter your password
6. Training data set will be installed to mysql database. You can check it. 
7. Update credentials into db_connect.php file (username and password)
8. Paste a paragraph which you want to classify in data.txt file
9. To classify use command `php main.php`    

This application is based on classifying real estate data as spam or ham i.e it takes a paragraph as input and classify it
as ham if paragraph deals with real estate data else classify it as spam. 
However this application can be used for classification of any type of data. All you have to do is use your own training set or 
create an entirely new training data set (discussed below).


### How to make your own training set?

1. Notice train.html file. This will be used to train the classifier and build training set. 
2. Delete all existing data from mysql table trainingSet. Use command
    `delete from trainingSet;`
3. Open train.html file via apache web server in browser
4. Paste data either in ham or spam category and submit it.
5. You can check new training data set into trainingSet table

###### For any bug/mistake you can create github issue. Contact varunon9@gmail.com for suggestion/query. 