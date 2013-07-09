Mantis 2 Zendesk
-

PHP Application to migrate **Mantis bugs to your Zendesk**, as issues.  
By Tomás Prado, Brahim Lachguer and Mustapha Koumach  
AGPL-3.0  

Installation for Linux
-

**1. Curl Installation**

Do you have curl? If you don't, follow this instructions below:

* Execute in your terminal: 

<code>sudo apt-get install php5-curl</code>

* Modify your *php.ini* adding this

<code>extensions=curl.so</code>

* Restart apache:

<code>sudo service apache restart</code>

**2. Clone the Mantis 2 Zendesk files**

* Go to **/var/www/**
* git clone the repository 

<code>git clone https://github.com/tomas2387/mantis-zendesk.git</code>

**3. Configure**

* Go to mantis-zendesk folder

<code>cd /var/www/mantis-zendesk</code>

* Edit the settings.php file and edit these lines 

****Your mantis credentials****  
<code>
define('ENDPOINT', 'http://YOURMANTISURL/api/soap/mantisconnect.php');  
define('MANTIS_USERNAME', 'YOURMANTISUSERADMINISTRATOR');  
define('MANTIS_PASSWORD', 'YOURMANTISPASSWORD');</code>

****Your zendesk credentials****  
<code>define("ZDAPIKEY", "Yourzendeskapikey");  
define("ZDUSER", "your@emailatzendesk.org");;  
define("ZDURL", "https://yourorganizationurl.zendesk.com/api/v2");</code>  

**4. Use it!**

* Open your browser and go to http://localhost/mantis-zendesk/


----------------------

Installation for Windows   
_

***1. You will need a webserver!** 

Install wampserver for example. 
http://www.wampserver.com/en/

***2. Curl Installation**   


2.1 Close WAMP (if running)
2.2 Navigate to WAMP\bin\php\(your version of php)\
2.3 Edit php.ini
2.4 Search for curl, uncomment extension=php_curl.dll
2.5 Navigate to WAMP\bin\Apache\(your version of apache)\bin\
2.6 Edit php.ini
2.7 Search for curl, uncomment extension=php_curl.dll
2.8 Save both
2.9 Restart WAMP

***3. If you have git then clone the repository using the terminal**    
<code>cd C:/wamp/www/</code>    
<code>git clone https://github.com/tomas2387/mantis-zendesk.git</code>    

If you don't have git, download the project from here   
https://github.com/tomas2387/mantis-zendesk/archive/0.1.zip

and unzip it to C:/wamp/www/    

***4. Configure**   

Go to the mantis-zendesk folder    

<code>C:/wamp/www/mantis-zendesk</code>   

Inside, you will find a settings.php file. Edit it.    


****Your mantis credentials****  
<code>
define('ENDPOINT', 'http://YOURMANTISURL/api/soap/mantisconnect.php');  
define('MANTIS_USERNAME', 'YOURMANTISUSERADMINISTRATOR');  
define('MANTIS_PASSWORD', 'YOURMANTISPASSWORD');</code>

****Your zendesk credentials****  
<code>define("ZDAPIKEY", "Yourzendeskapikey");  
define("ZDUSER", "your@emailatzendesk.org");;  
define("ZDURL", "https://yourorganizationurl.zendesk.com/api/v2");</code>  



***5. Use it!**    

Open WAMPSERVER and start the server!     

Then open your favorite browser, and go to     

http://localhost/mantis-zendesk/







