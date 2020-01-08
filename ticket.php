<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index Page</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css" />
    <link rel="stylesheet" href="fonts/fonts.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <header>
      <div class="container">
        <a href="index.html"><img class="logo" src="img/logo.png"/></a>
        <div class="menu-btn not-active"><span></span></div>
        <ul class="menu">
          <li><a href="#">faq</a></li>
          <li><a href="#">contact us</a></li>
          <li><a href="#">login/register</a></li>
          <li><a href="#"></a></li>
        </ul>
      </div>
    </header>
    <main>

      <form class="ticket" action="php_process/ticket_process.php" method="post">
        <h1>Please fill out the form</h1>
        <div class="form_div">
          <h3>Type of the incident</h3>
          <select class="inp_bord" name="type">
            <option value="query">query</option>
            <option value="wish">wish</option>
            <option value="crash">crash</option>
            <option value="functional_problem">functional problem</option>
            <option value="technical_problem">technical problem</option>
          </select>
        </div>
        <div class="form_div">
          <h3>Please Write topic</h3>
          <input
            class="inp_bord"
            type="text"
            name="topic"
            placeholder="topic"
          />
        </div>
        <div class="form_div">
          <h3>Short description of issue</h3>
          <textarea
            class="form_text"
            name="description"
            placeholder="description"
          ></textarea>
        </div>
        <div class="form_div">
          <h3>How often does issue occurs</h3>
          <select class="inp_bord" name="freq">
            <option value="hardly_ever">hardly ever</option>
            <option value="sometimes">sometimes</option>
            <option value="often">often</option>
            <option value="always">always</option>
          </select>
          <p><input class="inp_bord" type="submit" value="submit" name="submit" /></p>
        </div>
      </form>
    </main>
    <footer>
      <div class="container clearfix">
        <div class="footer_logo"><img src="img/logo.png" alt="" /></div>
        <div class="footer_contacts clearfix">
          <h3>Contacts</h3>
          <p>supportdesk@info.com</p>
          <p>+1234567890</p>
        </div>
      </div>
    </footer>
    <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
    <script src="js/core.js"></script>
  </body>
</html>