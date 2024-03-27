Account page:
I started off by listing out different things that the account page should have (user information- full name, home country, pronouns, PFP; sensitive stuff- change password, delete account). Then I did a quick sketch of what I wanted the page to look like for a couple of different options to have an idea of what things should be like in the end. When I started making the actual page, I focused on getting the format of the main content to be how I wanted at first. I planned on having a bunch of different information separated into sections and didn't want the page to reload everytime a user switches to another section, so at first I planned on having content in separate PHP files. That didn't work since trying to set the innerHTML to a PHP file from Javascript would comment out the PHP since it would be recognized as invalid HTML. Then I tried to put the content into separate strings that I would switch the innerHTML to when a specific section gets clicked, but that didn't work out since it messed up the Javascript functionality after switching sections once. After neither of those worked, I tried putting everything into one file and using CSS and JS to decide when each section to show, but that got pretty unruly quickly. I ended up deciding to just let the page reload when switching to different sections and put each section into its own PHP file, making everything much easier to read in each file.

Accounts table:
I looked at the accounts page to figure out what information needed to be in the table. I decided that we needed a userid, username, password, display name, pronouns, home country, and email. I decided to get rid of the phone number since I didn't see what use there was in having it. Then, I thought about how passwords should be stored. I looked up some stuff and found that I should use hashing algorithms that also use salting such as Bcrypt and Argon. But, I was still a little confused on how I would then be able to check for correct passwords since the salt would randomize the password a little bit. After reading into the password_hash() function from PHP, I found the password_verify() function would solve this issue since the salt and algorithm used are somehow included in the hashed password. After that, I wrote up some code to connect to a database, update a record if a form was submitted, and grab data to display after that. Then, I wrote up some code to check if an inputted password is correct, using the previously mentioned password_verify() function. I ran into an issue where the page would reload after submitting the form despite my function returning false. After trying to return false in both an AJAX call as well as the function it's wrapped in, I tried putting return false after the function call in the onsubmit attribute and things magically worked. Besides that, I ran into another issue and I had no idea what was happening since it was happening during an AJAX call. Eventually I figured out I should look at the network tab in devtools and found a hidden error in the response of a request for a php file that I was doing. One more issue that I was trying to let a form submit depending on an asynchronous condition (if AJAX call returns true, do the action, otherwise don't). After looking through some stackoverflow posts, I found one that showed that you could make the form not reload and then use Javascript to submit the form if the asynchronous condition was met. After the lecture on PDOs, I decided to update my code to use PDO instead of mysqli and use prepared statements to prevent SQL injections.

Travel log:
To make the travel log, I first sketched how I wanted it to look. I realized I needed more tables to store stuff for travel logs, so I ended up making two tables for that. While making the page, I really struggled with figuring out how to allow multiple images to be uploaded and to check that all the uploaded files really are images. I ended up using ChatGPT after searching for a long time and got a solution for it. Then, I made the code to upload everything into the tables and upload images into directories. That also took a long time to figure out since the way that files uploaded through a form are accessed in PHP is different.

Country content:
We decided that to get information about businesses and things that would be of interest to people, we would use Yelp to get info and Google Maps Street View to display what the actual place looks like on our page. It seemed pretty easy at first to use the Yelp Fusion API to look for businesses given a country and activity term (restaurants, hiking, etc.), but I ran into issues with CORS. I eventually ended up asking ChatGPT about this issue and figured out I would need to do the API call from the backend instead to avoid CORS, so I had to make an API call from PHP (which I also got the code for from ChatGPT). After that, I also had issues with figuring out how to use the Street View API since on Google Maps Street View website, it only showed you how to use the API using Typescript. I had to end up asking ChatGPT how to do this in vanilla Javascript as well and things ended up working out well.

Sources:
https://css-tricks.com/snippets/css/a-guide-to-flexbox/
https://www.w3schools.com/jquery/jquery_css.asp
https://api.jquery.com/click/
https://stackoverflow.com/questions/9754111/css-hover-effect-does-not-work-after-running-jquery-function
https://developer.mozilla.org/en-US/docs/Web/CSS/filter-function/drop-shadow
https://stackoverflow.com/questions/554273/changing-the-image-source-using-jquery
https://medium.com/front-end-weekly/absolute-centering-in-css-ea3a9d0ad72e
https://stackoverflow.com/questions/247304/what-data-type-to-use-for-hashed-password-field-and-what-length
https://www.php.net/manual/en/function.password-hash.php
https://www.php.net/manual/en/function.password-verify.php
https://www.w3schools.com/mysql/mysql_create_table.asp
https://www.w3schools.com/mysql/mysql_insert.asp
https://www.w3schools.com/php/php_mysql_update.asp
https://www.w3schools.com/php/php_mysql_select.asp
https://stackoverflow.com/questions/15757750/how-can-i-call-php-functions-by-javascript
https://html.form.guide/php-form/submit-form-without-reloading-page-php/
https://stackoverflow.com/questions/359047/detecting-request-type-in-php-get-post-put-or-delete
https://dushkin.tech/posts/js_assign_variable_in_switch/
https://stackoverflow.com/questions/21533285/why-the-ajax-script-is-not-running-on-iis-7-5-win-2008-r2-server/21617685#21617685
https://stackoverflow.com/questions/57790944/javascript-async-await-submitting-a-form-with-onsubmit-using-promise
https://www.php.net/manual/en/ref.pdo-mysql.php
https://stackoverflow.com/questions/8992795/set-pdo-to-throw-exceptions-by-default
https://www.php.net/manual/en/pdo.connections.php
https://www.quora.com/How-do-we-enable-error-reporting-in-PHP-for-AJAX-requests
https://stackoverflow.com/questions/5273844/php-trigger-ajax-error-code-without-using-array
https://www.w3docs.com/snippets/php/how-do-i-return-a-proper-success-error-message-for-jquery-ajax-using-php.html
https://stackoverflow.com/questions/20572639/get-patch-request-data-in-php
https://www.w3schools.com/php/php_file_upload.asp
https://chat.openai.com/
  - write javascript code to check if all files from an input are valid images. if at least one of them arent valid images, prevent the code from continuing
  - what is the e
  - is it possible to use the google maps street view api without using typescript
  - what to do about this error from yelp api call: Access to XMLHttpRequest at 'https://api.yelp.com/v3/businesses/search?location=USA&term=Restaurants&sort_by=best_match&limit=2' from origin 'http://localhost' has been blocked by CORS policy: Response to preflight request doesn't pass access control check: No 'Access-Control-Allow-Origin' header is present on the requested resource.
  - will doing an api call in php bypass the cors error
https://stackoverflow.com/questions/23980733/jquery-ajax-file-upload-php
https://stackoverflow.com/questions/2303372/create-a-folder-if-it-doesnt-already-exist
https://stackoverflow.com/questions/24168040/upload-multiple-files-with-php-and-jquery?rq=3
https://www.sitepoint.com/get-url-parameters-with-javascript/