# Queue_App


DATABASE QUERY 

# To create database
CREATE DATABASE queueapp;

# To create Table
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_served` int(11) DEFAULT '0',
  `priority` int(11) DEFAULT '0',
  `queued_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Steps

1) Execute the query to run the App.

2) Update the /app/Config/AppConfig.php 


# PHPUNIT 

PHPUNIT has written for this App. please install phpunit to run the test.

If you dont have PHPUNIT on your machine, please find the link to install PHPUNIT

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

# Funtional Test

To test funtional test you may need to install Selenium server and Codeception on your machine.

Find the link here => http://codeception.com/install

