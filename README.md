# 60-307-Web-BasedDataManagement
Rental Listing Website Designed for the 60-307 web development course at the University of Windsor. This is used exclusively for educational purposes for the web development course at the University of Windsor, and has been shared here as a teaching tool. It cannot be used for any commercial projects.

![main](https://user-images.githubusercontent.com/20860945/36062390-99d5931c-0e39-11e8-8169-dac080657420.png)

# Application Purpose and Users 

A work-flow based application used to rent out rooms via advertisements placed on the website to tenants, from landlords with a valid rental license for apartments, or houses in Canada. Landlords can provide a listing on rooms for users to view. A tenant user browses the website containing advertisement on rooms for rent, and can contact the landlord, and send an application for the room. Tenants can also create a listing on the website to search for a room mate. Tenants and landlords have to register on the website by inputting data, in which the super-user (administrator) will verify the information and approve, or disapprove of the account for the landlords account. The super-user (administrator) also decides whether to approve or disapprove the listing by the landlord or tenant.

# Data Storage

Data is stored in the MySql database as tables:

Table: tlauseraccount
A record of all registered tenant and landlord users. Each user has a unique user id which acts as the primary key for the table. This table is for user authentication for a regular account for tenants and landlords. Landlord account have to be approved by the administrators who will review the credentials of the landlord, mainly to prevent tenants from being defrauded.

CREATE TABLE `tlauseraccount`(
  user_name varchar(20) NOT NULL,
  create_date DATETIME,
  password varchar(64) NOT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  city varchar(100),
  prov char(2),
  email varchar(100) NOT NULL,
  accounType varchar(10) NOT NULL,
  isValid varchar(10) NOT NULL,
  PRIMARY KEY (user_name)
) ;

  
Table: tlaadvertisement
A record of all advertisements posted by the tenants and landlords for others to see. The advertisements need to first be approved by the admin before releasing the ad to the website, and includes advertisements relating to the search of other users looking for tenants or landlords.

CREATE TABLE `tlaadvertisement` (
  `id` char(23) NOT NULL,
  `advertisement_title` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,   
  `date_Posted` datetime NOT NULL,
 `status` varchar(100) NOT NULL, 
 `img_link` varchar(100) NOT NULL, 
 `account_type` varchar(100) NOT NULL,
 `user_name` varchar(20) NOT NULL, 
 `price` float(12,2) NOT NULL, 
  PRIMARY KEY (`id`)
) ;


Table: adminstrator
Adminstrator access for super user. The table shows the control and permissions the super-user has on the tenant and landlord accounts, as the admin decides whether the landlord account is approved, or the ads created by tenants or landlord are approved. 

CREATE TABLE `tlaadminstrator`(
  user_name varchar(20) NOT NULL,
  create_date DATETIME,
  password varchar(64) NOT NULL,
  accounType varchar(10) NOT NULL,
  isValid varchar(10) NOT NULL,
  PRIMARY KEY (user_name)
) ;

# Security

There are four user levels; super-user (administrator), authenticated landlord user, authenticated tenant user, unauthenticated user., in which the unauthenticated user is restricted from the website besides browsing the advertisements listed. The super-user approves of landlord accounts, although both tenant users and landlord users have to go through the registration process. Tenant users and landlord users can post advertisements but both are under two different categories and must be approved by the super-user. User authentication is done on every page using session variables.

# Scripts

**about.php** is the a general information page that is used to give a brief description 
of what the website is about.

**accAdmin.php** is the admin account page where admins make decisions on whether accounts are removed, or approved, or whether to approve or remove advertisements posted by tenants or landlords.

**confirmation.php** is a regular confirmation page that appears after a user registers an account. Used as feedback for users registering.

**confirmation2.php** is a regular confirmation page that appears after a user posts an ad. Used as feedback for users posting ads.

**contact.php** is a fairly generic contact page that uses a regular html post request to send an email to the web site developer.

**createAdmin.php** is used to create an admin account on the web server. If the
variables $adminUsr and $adminPass are changed, the values are tested for duplication. If there is no duplications using the primary key "username" stored in the database, then an admin account is created using the data stored in those two variables. The two variables only need to be changed, then the file should be runned on the browser to have the admin account be created. 

**Index.php** is the central page for the website and is used for redirection. It will allow authenticated users to be redirected to the appropriate page corresponding to the user account type. Users who are not authenticated will be redirected to the login.php. User authentication is tested using session variables.

**landlordHome.php** is the home page for the users with an authenticated landlord account. Users can navigate using the menus at the top, as well as post ads.

**tenantHome.php** is the home page for the users with an authenticated tenant account. Users can navigate using the menus at the top, as well as post ads.

**login.php** is the login page for users to sign into. Authenticated users, or users who are not logged in the website will be sent here. A form is used to validate inputted information to determine if the user has an account on the database. Users can also click on text to be redirected to the registration page if they do not have an account.

**registration.php** is the registration page for users to create an account. This page allows users to register an account by inputting information to a form which is checked for validation. Users can be redirected to the login page by clicking on text placed somewhere on the same page.

**registerForm.php** is the registration form used for the creation of the UI for registration.php. 

**loginForm.php** is used for the creation of the UI for login.php. 

**logout.php** is simply used to logout by removing session data, then redirecting back to the index page. 

**outputPage.php** displays the advertisement that the user clicked on in full detail referencing the id with a GET request.

**outputPageAdmin.php** displays the advertisement that the ADMIN user clicked on in full detail referencing the id with a GET request. The difference between this page and outputPage.php is that this one is for admins to see the advertisement in full depth, when logged in.

**search.php** outputs a table containing data that contain key words specified by the user on the search bar using a GET request.

**submitAd.php** is used to submit advertisements using user input on a form that uses a POST request.

**userAds.php** is the user advertisement page that generates a table listing all of the ads the user has created along with its status. This web page also shows ads that are rejected.

**web_db.php** is used to provide information needed to connect to the database.

**webStyle.css** is the style sheet for the entire webpage.

 
# List of Sources
*These sources are also stated on each webpage document.

**accAdmin.php, landlordHome.php, tenantHome.php, userAds.php, search.php:**
These pages are a heavily modified form of my guestbookadmin.php solution sent in for the Assignment in module 4. But the original creator of the complete file was Stephen Karamatos, so credits go to him for providing the files as a resource for learning.

The complete file provided by Stephen Karamatos without guestbookadmin.php can be found here: http://307.myweb.cs.uwindsor.ca/apps/show-m4a

**Login.php,registration.php:**
These pages are a modified version of login_register.php created by Stephen Karamatos, credits go to him for providing the file as a resource for learning.


**loginForm.php, registerForm.php:**
These scripts are a modified version of login_register_form.php created by Stephen Karamatos, credits go to him for providing the file as a resource for learning.


**logout.php:**
A non modified version of logout.php created by Stephen Karamatos for assignment 6, credits go to him for providing the file as a resource for learning. I don't claim any credit in the making of this file. The file is used for educational purposes for the user to log out of the website.

**outputPage.php,outputPageAdmin:**
These pages are a heavily modified form of my guestbookadmin.php solution sent in for the Assignment in module 4, as well as guestbook.php created by Stephen Karamatos for the submit form. The original creator of the complete file was Stephen Karamatos, so
credits go to him for providing the files as a resource for learning. 

 
**submit.php:**
This page is a heavily modified form of my guestbookadmin.php solution sent in for the
Assignment in module 4, as well as guestbook.php created by Stephen Karamatos for the submit form, and task5_upload.php for the image upload portion of the form. 
The original creator of the complete file was Stephen Karamatos, so
credits go to him for providing the files as a resource for learning. 


# The following libraries are used:

# Datatables Library:
Use data tables library to change tables generated on the webpage. I do not claim ownership for the software library or for the creation of it. The license falls under a MIT License and can be 
found here: https://datatables.net/
Link to license: https://datatables.net/license/mit
Copyright (C) 2008-2016, SpryMedia Ltd.

# TinyMCE Library:
The tiny MCE library is used to change the text area for the form input on the webpage. The free version is used. I do not claim ownership for the library or for the creation of it. 
The library falls under a Open Source (LGPL 2.1) License and can be 
found here: https://www.tinymce.com/
Link to license: https://www.tinymce.com/pricing/
Copyright (C) 2016, Ephox.

# Jquery Library:
I do not claim ownership for the software library or for the creation of it. 
The license falls under a MIT License and can be 
found here: https://jquery.org
Link to license: https://jquery.org/license/
Copyright (C) Copyright 2016 The jQuery Foundation


# Images:
All images on the website have been taken from image hosting sites that fall under the Creative Commons CC0 license.

Links to some of the images used:
https://stocksnap.io/photo/ED9ECE320A
https://openclipart.org/detail/11066/users

 
# Created accounts for testing:
*These accounts were created for testing various things on the web pages and are example accounts. You can register for an account as well.

**Tenant accounts:**

1\)
username: studentacc
password: randompass

2\)
\(This account is unverified, so you can't login unless you change the status
using the admin account.\)
username: mrslow
password: topgear

3\)
username: tenantacc
password: password


**Landlord accounts:**

1\)
\(This account is unverified, so you can't login unless you change the status
using the admin account.\)
username: landlordacc
password: randompassagain

2\)
username: landlordtest
password: password

3\)
username: testlag
password: password12

**Admin accounts:**

1\)
username: myAdmin
password: adminPass




**Link to test file:**
youruser.myweb.cs.uwindsor.ca/webSiteFinal/login.php

Or

youruser.myweb.cs.uwindsor.ca/webSiteFinal/


# Additional Notes:
*If you plan to upload the files to your own server for testing, then to create admin account, run this file after editing the two variables on createAdmin.php (instructions are in the php file):
http://youruser.myweb.cs.uwindsor.ca/webSiteFinal/createAdmin.php

*Search bar is incomplete, it somewhat works.

*Account button on top right of the webpages after a user logs in, is not set up.
-It was suppose to allow users to edit profile information, but was not completed on time.



