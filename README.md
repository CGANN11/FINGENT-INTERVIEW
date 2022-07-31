
## installation steps as per XAMPP
## ------------------------------------
** used versions
PHP - 7.4.22
Laravel - 8.83.23
Composer - 2.1.6
## -----------------------------------
Step 1 :- clone project from the repositiory to your server folder
            go to htdocs folder and run command prompt, and run the following command
        **
            git clone https://github.com/CGANN11/FINGENT-INTERVIEW.git
        this command will create new folder FINGENT-INTERVIEW also download the code from the master branch of Git repository
Step 2:-checkout to the develop branch
        ** 
            git checkout develop
        it will merge all the codes from develop branch to your folder
Step 3:- copy the .env.examples and rename the copied file to .env
Step 4:- create a new database and copy the name and paste it to the variable DB_DATABASE in the .env file
         also add the Database password, username and other details
Step 5:- run composer install
        composer version required 2.1.6
        it will create the vendor folder
Step 6:- generate keys for the application
    ** php artisan key:generate
step 7:- run the migrations and seed
    ** php artisan migrate --seed
step 8:- run the server
    ** php artisan serve
    and call the site with url http://127.0.0.1:8000/
    then you can view the site

**Apllication flow

Step 1 :- Reporting Teacher and subjects are already seeded with respective tables you can view the lists from the list menu under respective submenus
Step 2 :- Student Menu will give the option to add/edit/delete students personal details and mark details to the system 
