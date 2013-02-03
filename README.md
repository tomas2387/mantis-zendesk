Mantis 2 Zendesk
-

PHP Application to migrate **Mantis bugs to your Zendesk**, as issues.  
By Tomás Prado, Brahim Lachguer and Mustapha Koumach  
AGPL-3.0  

Installation
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

<code>cd mantis-zendesk</code>

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


