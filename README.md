This is a project made primarily for sugar shack, my grandmother's business.

Team contributions:
  Jacob: 100%

Libraries & tools used:
  php-mysqli
  php-parsedown
  php-phpmailer

  mjml was used externally for our email template.

To run this project:

1. Clone the repository
2. If needed, point nginx to your fastcgi install in nginx.conf
3. There are a few config files that you will have to create yourself witin the config directory
  - login.ini, this contains a 'username' and 'password' field for the admin account.
  - emailParams.ini, this contains a 'host', 'username', and 'password' field for the user's choice of stmp server. (this project may work without this, but I am unsure).
  - dbParams.ini, this contains 'host', 'username', 'password', and 'dbName' fields to connect to a running Mysql database.

4. This project uses a mysql database. There is a schema.sql included in this repo for easy importing.
5. The standard web traffic ports need to be opened (80 and 443).
6. This project will use https by default, this can be changed within the nginx.conf file.
7. the root variabl of the nginx config file will need to be changed to your custom directory path.
8. to start to project, run nginx -c PATH_TO_CONFIG_FILE (nginx will assume you are in /var/www unless you use the -c). 
 
Things to know:

1. the login page is at '/login'. 
2. in the edit items page, fields can be clicked to edit them. Clicking on the circle in the bottom right adds a new item.
3. There is a running version of this project that can be found at https://copingseethingmalding.com
4. Images for items will be put in the images directory, with each image having a name of <item_id>.webp
