# AstonCV: CV Tracker

A PHP and MySQL web app where programmers create an account, publish a short CV, and search a shared
directory of CVs by name or main programming language. I built it during Year 1 of my BSc Computer
Science at Aston University to practise server-side web development with a relational database.

## Features

- **Registration** with email validation, a duplicate-account check and passwords hashed with
  `password_hash()` (bcrypt).
- **Log in and log out** with `password_verify()` and PHP sessions. The edit page redirects to log in
  if there's no session.
- **CV directory** listing every CV with name, email and key language.
- **Search** by name or programming language (SQL `LIKE` matching).
- **CV details page** for each person: education, profile and links.
- **Edit your own CV**: key language (Java, Python, PHP, C++ or JavaScript), education, profile and
  links. The form is pre-filled with what's saved.

## Tech stack

PHP 8 (PDO) · MySQL / MariaDB · HTML · CSS · XAMPP for local development

## Security notes

- Every query uses **PDO prepared statements** with bound parameters, so user input is never pasted
  into SQL.
- Passwords are stored only as **bcrypt hashes**.
- Data shown on the page is escaped with `htmlspecialchars()` to stop stored cross-site scripting (XSS).
- Database credentials sit in `config.php`, which is **git-ignored**. Only the template
  `config.example.php` is committed.

## Project structure

```
index.php         CV directory and search
register.php      sign-up form and account creation
login.php         log in, starts the session
logout.php        ends the session
cvupdate.php      edit your own CV (logged-in users only)
cvdetails.php     one person's full CV
nav.php           navigation bar (changes when you're logged in)
connectdb.php     opens the PDO connection using config.php
config.example.php  template for your database details
schema.sql        creates the cvs table
css/style.css     styling
```

## Run it locally (XAMPP)

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Clone this repo into `C:\xampp\htdocs\astoncv`.
3. In phpMyAdmin (<http://localhost/phpmyadmin>), create a database called `astoncv` and run
   `schema.sql` in it.
4. Copy `config.example.php` to `config.php` and enter your database details (XAMPP's default user is
   `root` with no password).
5. Open <http://localhost/astoncv/>, register an account, log in and fill in your CV.

## Possible next steps

- CSRF tokens on the forms, and session ID regeneration after login
- Server-side validation of the links field and length limits on the text fields
- Pagination for the directory
