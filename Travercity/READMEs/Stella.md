Website Demo Homepage:
For the demo's homepage, to start off I used the template of other pages that were already in the demo in terms of header and footer so that the page would have a consistent theme. After that, I went and added the headings and paragraph tags, with me adding a signup button on the bottom so that the user could easily go and create an account, which is very good because it makes it so that the user can have an action to do so they are more likely to do that instead of say that is interesting and leave the page. I then added the pitch on the front of the page because for the demo, we wanted people to easily see what were all about right up front.
Blog:
I then went to work designing the blog. To start off, I went and used the template that was provided by Star as a starting point. After this, I went and built off of this to create a Blog system. To do this, I first designed the PHP to read the Blog posts from the database, with me using the PHP login from ITWS-1100 as a base for this. This took a while, as there were lots of small changes that had to be made in order to make it not break. I also had to then adjust the file so that it used the database for each post, which ended up making scaling the code easier, with it then being that the post's file can just have the post and its comments, with us agreeing to this method so that the database isn't clutted by each comment. After this, I had to create the blog post button, which was the most annoying thing as I ended up using w3schools, stackoverflow, and chatGPT in order to get the spacing correct since clashes with other css made it so that no type of breakline was being acknowledged. After this, I then had to create the comment and blog post systems, which took some trial and error but finally worked. However, I then had to adjust it for case sensitivity on the server, which took a while due to the server not sending out PHP errors. I also made it so that the user can't add newlines in the text file, which would screw up the renderer. I then added it so the images were stored in a Blog_Posts folder so they didn't clog up the Country folder, which required some refactoring. I then did santization so that the user can't do SQL or HTTP injection with some help from w3schools. After this, I then added the new header and footer, which took a little bit of effort and after that, added the final curved design so that you have the website you see today.
Sources:
w3schools.com
-CSS
-PHP
-Other small fixes
ChatGPT
-CSS
-Other small help
Stackoverflow
-CSS
-PHP
-Other issues that arose
ITWS-1100
-PHP
ITWS-2110
-PHP
-CSS
-Other stuff we learned