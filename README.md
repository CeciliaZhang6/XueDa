# XueDa

Website home page: http://uccainc.com/csp1/index.html

## 6/26
Tested and fixed login/signup pages.
Encapsulated functions.

Future TODO: add email verification.

## 6/24
Worked on index and login/signup front and back end. 

Home page: http://uccainc.com/csp1/index.html
Login page: http://www.uccainc.com/csp1/login.html
Signup page: http://www.uccainc.com/csp1/signup.html


## 6/19
Web Structure
/csp1
├── index.php
├── dbh.php
├── functions.php
├── pics
└── pages
    ├── index.html (room preview)
    ├── signup.html
    ├── login.html
    ├── profile.html
    ├── rooms.html (all rooms)
    └── create-room.html


## 6/17
Set up data base. 

users
- id
- email
- password
- username
- name
- sender_ip
- org
- user_long
- user_lat
- creation_date
- allow_loc
- phone
- pfp
- is_public

rooms
- id
- title
- subject
- description
- date
- link
- host_id (user email, foreign key)
- sender_ip
- scheduled_date

tokens
- id
- is_valid
- sender_ip
- visit_date

