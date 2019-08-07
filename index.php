<?php include ("master.php") ?>

<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <meta http-equiv="X-UA-Compatible" content="ie=edge" />
          <link rel="stylesheet" href="style.css">
          <title>contact form</title>
     </head>
     <body>
          <div class="container">
               <h1>Contact Us</h1>
               <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" id="form">
               <div id="errormsg"><?php echo  $errors['fullname'].$errors['email'].$errors['confirm'] ?></div>
                    <label for="fullname">Fullname: <input  name="fullname"/></label><br />
                    <label for="email">Email: <input name="email"/></label><br />
                    <label for="msg">Your message: <br><textarea name="msg"></textarea></label><br />
                    <input type="submit" id="submitBtn" />
               </form>
          </div>
     </body>
</html>
