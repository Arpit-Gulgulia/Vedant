
#VEDANT

VEDANT is a web application which is an online version of books education where users can share their Educational lectures.

The websites comprises of different engineering educational category video lectures like for CSE, ECE, IT, Mechanical, CIVIL etc.

The website is user friendly and it compatible on different browser.

The website allows the user to create an account and use the site with the respective login.

It allows the user to watch educational videos and also allow user to like , subscribe and comment on videos and can also maintain their own profile in site.

The web application can be used by any Educational Institute and make their videos available to their students online so students can study even sitting in remote places.

The website is built using CodeIgnitor3, a PHP MVC framework .

The information is stored in MYSQL database.

The website includes the following features
   1. Create account and Login System
   2. Uploading the Videos and Editing details of previously uploaded videos.
   3. Watching Videos
   4. Like and Comments on Videos
   5. Subscription 
   6. Trending, Recommendation, Subscription videos and Liked videos Pages
   7. Settings
   8. Profile page
   9. Search functionality
   
   
  Here I am showing how each features pages will looks like
  
  1.Creating an Account on Vedant
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/SignUp.png)
  
  2.Login Page
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/SignIn.png)
  
  3.Uploading Video
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Upload.png)

  4.Editing Videos details
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/EditVideo.png)
  
  5.Watching Video
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Watch.png)
  
  7.Trending Videos
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Trending.png)
  
  8.Subscription Videos
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Subscription.png)

  9.Liked Videos
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/LikedVideo.png)
  
  10.Settings Page
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Settings.png)
  
  11.Profile Page
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Profile.png)
  
  12.Search functionality
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Search.png)
  
  13.Home Page
  (https://raw.githubusercontent.com/Arpit-Gulgulia/Vedant/master/Screenshot/Home.png)

  

## **Features Description**

### *Creating an Account on Vedant**

User can create an account on Vedant using Signup form as shown above.

To create an account on Vedant he need to give correct input which should match with some set of rules like

   1. First name, last name should only have to contain alphabetic characters.
   
   2. Username should also contains alphabets characters only and it must be unique.
   
   3. Passwords must be atleast 8 characters long and can only alphabets and numbers.
   
   4. A valid email should given by users.

Once the signup button is clicked, the user credentials will get stored in MYSQL database in an encrypted format.


### *Signing on Vedant*

User can Login on Vedant using Login form as shown above.

Login to the website can be done by using their respective username and password otherwise error will be shown to user.

On clicking the login, the application will authenticate the user with the credentials stored in database.


### *Home Page*

In the home page, the subscription videos , recommended videos will be shown to users along with search form, and links to pages like upload form , trending , liked, subscription videos etc.

### *Video Upload*

After login an user can upload any kind of videos. All videos format like MPG, . MP2, . MPEG, . MPE, . MPV., OGG etc are accepted.

These videos are finally covert into one common format that is mp4 as it is format which are supported by all browser. For this I used ffmpeg tool. And using this tool we also created three thumbnails of every uploaded videos and one of them is used to show it to users as a link to video.

Upload page has features like title, descriptions, category etc. 

Once the upload button is clicked, it gets stored in server with mp4 format and its path to server will be stored in database.

### *Watch a Video*

A user can watch all uploaded video and each times its views get incrementend.

A user can like or dislike or comment on videos only if he is logged in otherwise an alert will be shown.

A user can like other users comment and can also reply to it but again he has to be logged in first.


### *Other Features: Trending, Recommended, Liked videos*

Vedant also has several other features like trending videos, liked video, subscriptional videos and recommended videos.

In trending video page user can see last 7 days videos with most views.

And in Liked videos page, all previous videos that are liked by users will be shown.

In Recommended videos page, any 15 videos random will be picks from database to give user more real experience.



  
  
