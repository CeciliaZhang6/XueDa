# XueDa Dev Log

Website home page: http://uccainc.com/csp1/index.php

TODO:
- user profile room update

DEBUG / FUTURE LIST:
- home page banner control (dots on bottom) not precise
- blocked list
- check other user's profile

DONE!!:
- user profile room delete
- password hashing
- fix profile front end & create forms for user room delete/update
- add SESSION for bio, username, etc.
- user profile update front end: 1. add button to display update form 2. form styling
- user profile edit/update backend done
- change nav bar options based on login status
- fix front end UI
- create room page front end design
- update profile UI
- add checking login status for create room page
- fetch data in user profile page (for personal profile only)
- when first time opening up webpage, all rooms cannot be rendered

## 8/26
- adding room update form
- fixing an issue where newly created room is not directly displaying on user profile

## 8/19 & 21 Implementing & Testing
- user profile room delete implemented and tested
- added password hashing when auth


## 8/12 & 14 Debugging
- Fixed signup form bug (caused by conn close). 
- Added password hashing and upgraded security. 

## 8/7
Adding user post delete function and wrapper php. 

Implement plan: 
1. add room id when fetching
2. add delete button when in editing mode for rooms
3. create a hidden form containing user email and chosen room id (use dom in js to keep track of room id)
4. create a yes/no form for user to confirm deletion
5. call delete_post().

## 8/5
Now profile displays username and bio with support for update these two fields when edit button is clicked. 
Fixing UI and styling.

## 7/31
Added a form so the user can update username (required), bio, org, and phone. 
Planning to rework DB design so all columns are not null. 
Planning to make the update form hidden and only show when edit button is clicked. 

## 7/29
Fixing user profile & nav bar.

## 7/26
August Plan:
w1 => profile CRUD
w2 => profile CRUD
w3 => post CRUD
w4 => debug & wrap up
w5 => debug & wrap up

Updates: 
- added posting display for user profile
- fetching function takes in target user's email
- FUTURE TODO: allow viewing others profile


## 7/24
Updates: 
- now correctly displays the session id (username) upon login/logout
- can show all user's posts with room APIs
- upon room creation, user_post_api is updated with all rooms this user created

## 7/17
Creating a lcoal copy of server DB to support user persistence:
- "local storage" or cache
- user can still browse *some* data when no connection to server
- just save a partial copy after getting new data from server

## 7/15
MVC Architecture for loading user profile

M = model

V = view

C = controller

Model represents data and internal logic that determines how to manage data and logic flow. 
View is the front end presented to the user. 
Controller is the middleware that connects front end request to the backend model. 

## 7/10
System Architecture:
Client --(request)--> API --(get)--> Other Client(post, profile) --(respond)--> Client 

## 7/8
Advanced posting done. Now it uses roomAPI to fetch and post rooms. 
Started working on update APIs when inserting new rooms, and personal profile pages. 

## 7/3
Simple posting (old method, echo everything) worked. 
Added APIs for rooms, started working on advanced posting using APIs and fetching in js. 

## 7/1
Fixed file names & link names. 
Working on posting feature. 

## 6/26
Tested and fixed login/signup pages.
Encapsulated functions.

Future TODO: add email verification.

## 6/24
Worked on index and login/signup front and back end. 

Home page: http://uccainc.com/csp1/index.php

Login page: http://www.uccainc.com/csp1/login.html

Signup page: http://www.uccainc.com/csp1/signup.html


## 6/19
Web Structure

    /csp1
    ├── index.php
    ├── dbh.php
    ├── functions.php
    ├── pics
    └── pages (currently everything in root)
        ├── index.html (done)
        ├── signup.html (done)
        ├── login.html (done)
        ├── profile.html
        ├── rooms.html
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

