
## installation steps as per XAMPP
## ------------------------------------
** used versions
</br>
PHP - 7.4.22 
</br>
Laravel - 8.83.23
</br>
Composer - 2.1.6
</br>
## -----------------------------------
Step 1 :- clone project from the repositiory to your server folder
</br>
            go to htdocs folder and run command prompt, and run the following command
</br>
        ** git clone https://github.com/CGANN11/FINGENT-INTERVIEW.git
</br>
        this command will create new folder FINGENT-INTERVIEW also download the code from the master branch of Git repository
</br>
Step 2:-checkout to the develop branch
</br>
        ** git checkout develop
</br>
        it will merge all the codes from develop branch to your folder
</br>
Step 3:- copy the .env.examples and rename the copied file to .env
</br>
Step 4:- create a new database and copy the name and paste it to the variable DB_DATABASE in the .env file
</br>
         also add the Database password, username and other details
</br>
Step 5:- run composer install
</br>
        composer version required 2.1.6
</br>
        it will create the vendor folder
</br>
Step 6:- generate keys for the application
</br>
    ** php artisan key:generate
</br>
step 7:- run the migrations and seed
</br>
    ** php artisan migrate --seed
</br>
step 8:- run the server
</br>
    ** php artisan serve
</br>
    and call the site with url http://127.0.0.1:8000/
</br>
    then you can view the site

</br>
**Apllication flow

</br>
Step 1 :- Reporting Teacher and subjects are already seeded with respective tables you can view the lists from the list menu under respective submenus
</br>
Step 2 :- Student Menu will give the option to add/edit/delete students personal details and mark details to the system 
