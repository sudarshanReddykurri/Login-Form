## Simple PHP/MySQL Login Form

### Description:
A simple login form with functional user registration and account creation. The login and registration pages both pull their data from a MySQL database which stores the information provided upon account creation. The MySQL database is protected against MySQL Injection attacks by the usage of the "mysql_real_escape_string", other than that all security falls to the user. There is multiple error checking on the username and password as well as all passwords are __hashed__ & __salted__  before being stored in the table.

### Usage:
Simply put the files in your *AMP/APACHE Directory and then navigate to that directory in your browser. To create the database, run the script provided in the __MySQL__ folder. If that doesn't work login to your MySQL via the Terminal/Command Prompt, and copy and paste the script into there. To create accounts simply use the __Registration__ page, and fill in the appropriate data. 

### Licence:

Copyright (C) 2011 by Jason Lennstrom

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
