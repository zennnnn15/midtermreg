<!DOCTYPE html>
<html>
<head>
  <title>Form Cards</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .card {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 10px;
      height: 400px;
    }

    .image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .formName {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .formDesc {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Events</h1>
    </div>
  <div class="container">
    <div class="row">
      <?php
        include 'database/dbcon.php';
        // Fetch the form data from the database
        $sql = "SELECT `formID`, `formName`, `image`, `formDesc` FROM `form`";
        $result = $con->query($sql);

        // Loop through the forms and create card elements
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            // Create anchor tag and card element
            echo '<div class="col-md-4">';
            echo '<a href="form.php?formID=' . $row["formID"] . '"><div class="card">';

            // Create image element
            echo '<img class="image" src="' . $row["image"] . '">';

            // Create form name element
            echo '<div class="formName">' . $row["formName"] . '</div>';

            // Create form description element
            echo '<div class="formDesc">' . $row["formDesc"] . '</div>';

            // Close card element and anchor tag
            echo '</div></a>';
            echo '</div>';
          }
        } else {
          echo "No forms found";
        }

        // Close database connection
        $con->close();
      ?>
    </div>
  </div>
</body>
</html>
