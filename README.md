Technical Test for Ying in Symfony2 and AngularJS

Once upon a time, there was a platform called The Hype Angels. This was the hype place where all the most daring angels came to post funny quotes of their fellow angel friends. Sadly, out of lack of time, the platform was not maintained and eventually it disapeared... All the smart and daring angels were very sad because they could not read their friends' funny quotes anymore.

## Your challenge: build a new platform to bring joy back into the angels community!

### Develop the platform:

- Create fixtures with 3 angels : each angel needs (at minimum) a name and should be linked to the citations they have said.
- Create a page with a form, where an anonymous (not logged in) angel can post a quote (a text field) and the name of the person who said it (a drop down list containing the three angels). The form should be done in AngularJS, backed with a Symfony2 API. A success message should be displayed if the AngularJS form is submitted with all the fields filled, and an error message should be displayed when the form is submitted with at least one empty field.
- On this same page, below the form, should be the list of quotes that have been submitted to the platform. Each time a quote is submitted in the form, it should appear at the top of the list without reloading the page.
- A quote should be displayed with the name of the angel and the text, as well as the date it was posted.
- On a different page, there should be the list of 3 angels subscribed to this platform.
- If we click on the name of an angel in this list, we are brought to a page which lists all the quotes this angel has said that were anonymously posted to the platform. The page should look exactly like the main page, but without the form.

### Test the platform

- The angels also want to make sure there are no bugs in the platform! They get very angry and become little devils when it does not work as it should. To avoid this situation, write PHPUnit tests to check that each possible request sends back a 200 HTTP code.

### The style
- A simple style is enough. The menu at the top of the page contains Home (the main quote page with the form), Angels, and the drop down list for Notifications. The style should be written in Sass.