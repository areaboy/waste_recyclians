Waste Recyclians:

An applications designed to help and encourage Users to recycle inorganic waste (Plastic Cans, bottles, Metals, Aluminum Cans ) etc. in an exchange for Cool Cash, Meals, Goods and Services.

The Application is powered by OpenAI, Google Gemini AI, Facebook Share, Google Map, Google Address Geo-Coding API, etc.



How To Test the Application Locally:

This application was written in PHP, Ajax, JQUERY, Bootstraps, Css, Mysql etc.



1.)You will need to Download and  install Xampp Server. After installation, ensure that Mysql Database and  Apache has been started and Running from Xampp Control Panel.

2.) Download and Unzip the main application folder eg waste_recyclians.zip to xampp htdocs directories e.g  C:\xampp\htdocs.  After unzipping the 
directory will look like  C:\xampp\htdocs\waste_recyclians

3.) Locate the database table called recyclers_db.SQL within the application sourcecode folder Eg. at /Database_tables/recyclers_db.SQL.

 Create a database name called recyclers_db and import it to your database via Phpmyadmin interface eg:  http://localhost/phpmyadmin/

4.) Edit Settings.php at /backend/settings.php to update your ChatGPT/OpenAI API Keys, Google Map API Key, Google Gemini API Key and other Parameters where appropriates.

5.) Edit db_connection.php at /backend/db_connection.php to reflect your mysql database credentials

6.) Callup the application on the browser Eg http://localhost/waste_recyclians/index.php

7.)Thank You





API Used

1.) Open Sourced Html Text Editor Markdown: https://github.com/markedjs/marked

2.) ChatGPT/OpenAI: https://platform.openai.com

To obtain Chatgpt API Keys. Goto this link below and signup https://beta.openai.com/account/api-keys

After that go to this link and get and generate ChatGPT api key and click on View API Keys https://platform.openai.com/account/api-keys

3.) Google Gemini AI :
To get started with Google Gemini AI and to get the API Key, visit https://github.com/google-gemini/cookbook/

4) Google Map Javascript API: Goto your Google cloud Console at https://console.cloud.google.com then create a project or select a project if you have created one in the past. then select API and Services Next click Enable API and Services
Next Click on Maps JavaScript API and Enable it. You are done.

5.) Google Address Geo-Coding API:

Goto your Google cloud Console at https://console.cloud.google.com then create a project or select a project if you have created one in the past. then select API and Services Next click Enable API and Services
Next Click on Geocoding API and Enable it. You are done.

6.) How to Get Google Map API and Geocoding API Key:

Goto your Google cloud Console at https://console.cloud.google.com then create a project or select a project if you have created one in the past. then select API and Services Next click on Credentials button at left sidebar next click Create Credentials Next select API Key and API key will be generated automatically. You are done.