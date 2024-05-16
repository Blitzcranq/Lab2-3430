<?php

// include class file
require("./includes/class_contact.php");
// get contents of post

$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$phoneType = $_POST['phone-type'] ?? '';
$area = $_POST['area-code'] ?? "000";
$phone = $_POST['phone'] ?? "000-0000";
$ext = $_POST['ext'] ?? "0000";
$contactType = $_POST['contact-type'] ?? [];

// declare errors array
$errors = [];


// if form has been submitted (check for submit in post)
if (isset($_POST['submit'])) {
  // if name is empty set name key in errors array to true
  if (empty($name))
    $errors['name'] = true;
  // use filter_var to validate email, check for empty and set error

  if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email) == true) {
    $errors['email'] = true;
  }
  // if no errors
  if (empty($errors)) {

    // start session
    session_start();

    // create new Contact object with contents from post, store in array in session
    $contact = new Contact($name, $email, $phoneType, $area, $phone, $ext, $contactType);
    $_SESSION['$contacts'][] = $contact;


    // redirect to addresss.php and exit
    header('Location: address.php');
    exit();
  }
  var_dump($errors);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Contacts</title>
  <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
  <header>
    <h1>My Address Book</h1>
  </header>
  <main>
    <nav>
      <h2>Menu</h2>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="contact.php">Add Contact</a></li>
        <li><a href="address.php">View Address Book</a></li>
      </ul>
    </nav>
    <div id="center-container">
      <h2>Add Contact Entry</h2>
      <form method="post" novalidate>
        <div class="form-item col">
          <label for="name">Name</label>
          <!-- make name sticky by setting value -->
          <input id="name" type="name" name="name" placeholder="Tom Jones" aria-required value=<?= $name ? $name : "" ?>>
          <!-- add the hidden class dynmaically depending of if the error is in the array -->
          <span class="error <?= (isset($errors['name'])) ? "" : "hidden" ?>">
            You must enter a name.
          </span>
        </div>
        <div class="form-item col">
          <label for="email">Email Address</label>
          <!-- make email sticky -->
          <input id="email" type="email" name="email" placeholder="tom@nookinc.com" value=<?= $email ? $email : "" ?>>
          <!-- make hidden dynamic -->
          <span class="error <?= (isset($errors['email'])) ? "" : "hidden" ?>">
            You must enter an email.
          </span>
        </div>
        <fieldset>
          <legend>Phone Number</legend>
          <div class="form-row">
            <div class="form-item col">
              <label for="phone-type" sr-only>Number Type</label>
              <select name="phone-type" id="phone-type">
                <option value="">Type</option>
                <option value="Mobile">Mobile</option>
                <option value="Home">Home</option>
                <option value="Work">Work</option>
              </select>
            </div>
            <div class="form-item col">
              <label for="area-code">Area Code</label>
              <input id="area-code" type="area-code" name="area-code" size="3" maxlength="3" placeholder="705" />
            </div>
            <div class="form-item col">
              <label for="phone">Phone</label>
              <input id="phone" type="phone" name="phone" size="8" maxlength="8" placeholder="748-1011" />
            </div>
            <div class="form-item col">
              <label for="ext">Ext</label>
              <input id="ext" type="ext" name="ext" size="4" maxlength="10" placeholder="1559" />
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Contact Type</legend>
          <div class="form-item row">
            <input type="checkbox" name="contact-type[]" id="friend" value="friend" />
            <label for="friend">Friend</label>
          </div>
          <div class="form-item row">
            <input type="checkbox" name="contact-type[]" id="family" value="family" />
            <label for="friend">Family</label>
          </div>
          <div class="form-item row">
            <input type="checkbox" name="contact-type[]" id="coworker" value="coworker" />
            <label for="friend">Co-worker</label>
          </div>
          <div class="form-item row">
            <input type="checkbox" name="contact-type[]" id="other" value="other" />
            <label for="friend">Other</label>
          </div>
        </fieldset>
        <div>
          <button id="submit" type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>
    <div id="right-side-container"></div>
  </main>

  <footer>&copy; COIS 3430, Inc. 2024 &mdash; Built by {{ vraj }}</footer>


</body>

</html>