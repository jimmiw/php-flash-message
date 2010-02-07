Did you ever want a way to display messages from an update, to a view?
Do you redirect the user away from the update location?

I've tried to make a small script that helps you do that, but it has a few assumptions in it.

### How does it work? ###

In order to get the script a test, you simply need to include the source file for it. Then you need to call the **flash(**label,message**)** function.

In my user/update.php that updates a user, I could have a the following code:

    <?php
      if(mysql_query("update user set updated_at = now() where id = 1")) {
        flash("success", "User information updated!");
      }
      else {
        flash("error", "Could NOT update user information!");
      }
      
      // redirects the user to the users page
      header("Location: /admin/users.php?id=1);
    ?>

The flash function then sets the message in the session, using the label you've given.

Let's say it went ok, and the user information was updated, then the session would hold the message, using the label "success".
On my view page on under the admin/users.php file, I could then have the following code:

    <?php
      if(isset(getFlash("success"))) {
        echo getFlash("success");
      }
      else if(isset(getFlash("error"))) {
        echo getFlash("error");
      }
    ?>

That is all you need!

if you have an error message, it will be displayed, same with your success message.

You have to remember to clear the messages though!
This is done relatively simple as well. Just call the following code on all your view pages:

    <?php
    
      // removes used and outdated flash messages.
      unsetFlash();
    
    ?>
