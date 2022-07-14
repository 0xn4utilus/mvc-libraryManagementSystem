# mvc-libraryManagementSystem
Simple Library Management System using MVC architecture written in PHP(7.4.3).

# Setup
* Install `Composer` using
```bash
composer install
composer dump-autoload
```

* Make a new database for importing mysql schema.
* Run the `setup.sh`.

# vhost-setup
Using apache2(2.4.41)

* Make a new file named `<Domain Name>.conf` in `/etc/apache2/sites-allowed`
* Paste the content from `sample-vhost.conf` into the file created earlier and edit the suggested data
* Add `127.0.0.1    <Domain Name>` to `/etc/hosts` 
* Run the following commands 
```bash
sudo a2ensite <Domain Name>
sudo service apache2 reload
```
* The site should be running now

# Usage
* It uses cookies and sessions.Cookies are set to expire in 30 days and are cleared upon Log Out.
* Homescreen shows list of books available in the library along with Login and Register Options.
* Upon login the User can view the available books, request to issue new book or return issued books which will be done after approval from Admin. User can also change password and logOut.
* Admin can add new books, delete current books, edit book information, approve pending issue and return requests, Change password and LogOut.
