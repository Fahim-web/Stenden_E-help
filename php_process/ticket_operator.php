<?php
include('header.php');
?>
<main>

  <form class="ticket" action="ticket_process_operator.php" method="post">
    <h1>Please fill out the form to add new customer</h1>
    <div class="form_div">
      <h3>Client Username</h3>
      <p><input type="text" name="client_username" placeholder="client username"></p>
    </div>
    <div class="form_div">
      <h3>Type of the incident</h3>
      <select name="type">
        <option value="query">query</option>
        <option value="wish">wish</option>
        <option value="crash">crash</option>
        <option value="functional_problem">functional problem</option>
        <option value="technical_problem">technical problem</option>
      </select>
    </div>
    <div class="form_div">
      <h3>Please Write topic</h3>
      <input type="text" name="topic" placeholder="topic" />
    </div>
    <div class="form_div">
      <h3>Short description of issue</h3>
      <textarea class="form_text" name="description" placeholder="description"></textarea>
    </div>
    <div class="form_div">
      <h3>How often does issue occurs</h3>
      <select name="freq">
        <option value="hardly_ever">hardly ever</option>
        <option value="sometimes">sometimes</option>
        <option value="often">often</option>
        <option value="always">always</option>
      </select>
      <p><input type="submit" value="submit" name="submit" /></p>
    </div>
  </form>
</main>
<?php
require("../html/footer.html");
?>