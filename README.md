# News/Blog Dynamic Website

A web application of news or articles. It is a responsive design website built with Bootstrap 5.

## Main Features

- User Registration
- Login/Logout System
- User Validations
- User/Admin Different UI
- Categorized Posts
- Modify Details

## How to start

##### You need to have [XAMPP](https://www.apachefriends.org/download.html) installed in your pc and follow these steps


First go to the **xampp** directory, then go to **htdocs** folder.
After that, open CLI or Git Bash & clone the repository from Github
```bash
git clone https://github.com/mwasifraza/blog-project.git
```
Now, switch to new directory:
```bash
cd blog-project
```

Setup the Database:
* Run XAMPP sever
* Open `localhost/phpmyadmin/` on web browser and create a database.
* Import sql file from **database/news-cms.sql**
* Database and tables are all set.

Go to **admin/partials/config.php** file and set the database you've just created.

Now, you are ready, your website will be live on `localhost/blog-project/`

