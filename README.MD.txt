----------------
| INSTRUCTIONS |
----------------

1. To start off, please make sure that Web Servers and DB Servers are functional.

2. Start by configuring the web server config file to point to a working directory where the files reside in.
   Example: In XAMPP, there is a file called httpd.conf. Set its "Directory Root" attribute to where the files reside in.
            # DocumentRoot: The directory out of which you will serve your
            # documents. By default, all requests are taken from this directory, but
            # symbolic links and aliases may be used to point to other locations.
            #
            #DocumentRoot "D:/XAMPP/htdocs"
            #<Directory "D:/XAMPP/htdocs">
            DocumentRoot "D:\XAMPP Workspace\BucksCrew_Server"
            <Directory "D:\XAMPP Workspace\BucksCrew_Server">   

3. After setting the directory root, sync the files down from GitHub.

4. Under the db folder, please sync down the test SQL file for as a testing table.

5. In the DB server manager (in XAMPP, it is normally under http://localhost/phpmyadmin/), Import the test SQL file. You may modify it for testing purposes.

6. To start testing, visit http://localhost/ and see if the results are as desired.

7. To test it on an Android device, please find the sample frontend zipped code under Android-fronted folder.
   7.1. Create a project with Android Studio to run this android code   
   7.2. Under the onCreate procedure in MainActivity.java file, you may try to comment or uncomment some test data as necessary.
   7.3. Proceed by running the project with BlueStack or built-in AVD if the web is hosted in localhost. Otherwise, any devices can be used for testing domain-name hosted servers.
   7.4. Test by varying the parameters and look for bugs!

