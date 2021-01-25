Simple-PHP-Blog
A simple blog in PHP where everyone can submit and manage posts.

1. To install :
   - Copy all folders and files.
   - Set the database following the informations bellow.
   - That's it, you'r ready to go!
   
2. Setting up the database :
   - Make a new database with the name of your choice.
   - Open the /config/database.php file, and change the default values with the correct ones :
   - user is the username you use to connect to the database
   - password is the password for that username
   - host is the name of your database host
   - port is the port of your database
   - dbname is the name of the database you created in step 1
   - In the CLI, copy/past : "vendor/bin/doctrine orm:schema-tool:update --force" for create database + table
   - You can feed database with fake data with privilege admin at this url : "/admin/feed_database"
   
3. How to create a post :
   - Click on dashboard with user Admin, click the button 'Ajouter un article'.
   - Complete the form. All fields are requiered.
   - Click on the button 'Enrengistrement' button bellow.
   
4. How to access the list of all posts :
   - All you need to do is to click on 'Articles' on the top of any page.
   
5. How to show a post :
   - Go to the list of all post (see section 4 above).
   - Click on the title or subtitle of the post you want to show.
   
6. How to edit a post :
   - Click on dashboard with user Admin, click the button 'Modifier un article'.
   - Select the post you want to edit.
   - You can now modify the post by editing the form that show up.
   - Click on the 'Modifier' button once you'r done.
   
7. How to delete a post :
   - Click on dashboard with user Admin, click the button 'Modifier un article'.
   - At the right of the dashboard page, click on the button 'Supprimer'.
   


List of extern librairies :
- Doctrine orm
- Twig
- Symfony Dotenv
- Adbario Php-dot-notation
- Fzaninotto Faker
- Nesbot Carbon
- Swiftmailer 