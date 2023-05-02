<?php
include 'database/dbcon.php';
$formID = $_GET['formID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <style>
    #spacer{
      margin-top: 50px;
    }
  </style>
  <div id="spacer">
  <div>
  <?php
  $get_formDetails = "SELECT * FROM `form` WHERE formID = $formID";
  $formDetails = mysqli_query($con, $get_formDetails);
  if (mysqli_num_rows($formDetails) > 0) {
    $formData = mysqli_fetch_assoc($formDetails);
    $formTitle = $formData['formName'];
    echo '<h1>' . $formTitle . '</h1>';
  }
  ?>
</div>

  <form id="myForm" class="container">
  <div id="error-container"></div>

        <?php
        
        $formquery = 'SELECT * FROM field WHERE formID = \'' . $formID . '\'';
        $formres = mysqli_query($con, $formquery);

        while ($row = mysqli_fetch_assoc($formres)) {
            $field_label = $row['fieldLabel'];
            $field_name = $row['fieldName'];
            $field_type = $row['fieldType'];
            $field_option = $row['field_option']; // add this line to retrieve dropdown options

            switch ($field_type) {
                case 'text':
                    echo '<div class="form-group">';
                    echo '<label for="'.$field_name.'">'.$field_label.'</label>';
                    echo '<input type="text" class="form-control" name="'.$field_name.'" id="'.$field_name.'">';
                    echo '</div>';
                    break;
                case 'textarea':
                    echo '<div class="form-group">';
                    echo '<label for="'.$field_name.'">'.$field_label.'</label>';
                    echo '<textarea class="form-control" name="'.$field_name.'" id="'.$field_name.'"></textarea>';
                    echo '</div>';
                    break;
                case 'number':
                    echo '<div class="form-group">';
                    echo '<label for="'.$field_name.'">'.$field_label.'</label>';
                    echo '<input type="number" class="form-control" name="'.$field_name.'" id="'.$field_name.'">';
                    echo '</div>';
                    break;
                case 'radio':
                    if ($field_name == 'gender') { // check if the field is for gender
                        echo '<div class="form-group">';
                        echo '<label>'.$field_label.'</label><br>';
                        $gender_options = ['Male', 'Female', 'Other']; // define the gender options as an array
                        foreach ($gender_options as $option) {
                            echo '<div class="form-check-inline">';
                            echo '<label class="form-check-label">';
                            echo '<input type="radio" class="form-check-input" name="'.$field_name.'" value="'.$option.'"> '.$option;
                            echo '</label>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="form-group">';
                        echo '<label>'.$field_label.'</label><br>';
                        $options = explode(',', $field_option);
                        foreach ($options as $option) {
                            echo '<div class="form-check-inline">';
                            echo '<label class="form-check-label">';
                            echo '<input type="radio" class="form-check-input" name="'.$field_name.'" value="'.$option.'"> '.$option;
                            echo '</label>
                            .</div>';
                          }
                            echo '</div>';
                    }
                            break;
                case 'date':
                  echo '<div class="form-group">';
                  echo '<label for="'.$field_name.'">'.$field_label.'</label><br>';
                  echo '<input type="date" class="form-control" name="'.$field_name.'" id="'.$field_name.'">';
                  echo '</div>';
                break;
                case 'time':
                  echo '<div class="form-group">';
                  echo '<label for="'.$field_name.'">'.$field_label.'</label><br>';
                  echo '<input type="time" class="form-control" name="'.$field_name.'" id="'.$field_name.'">';
                  echo '</div>';
                break;
}
}
?>
<button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>

</form>
  </div>
    

</div>


<script>
$(document).ready(function(){
  $('#submit-btn').click(function(e){
    e.preventDefault(); // prevent the default form submission behavior
    var formData = $('#myForm').serialize(); // get the form data as a serialized string

    // make an AJAX request to validate the form data
    $.ajax({
      type: 'POST',
      url: 'validation-handler.php', // replace with the URL of your validation script
      data: formData,
      success: function(response) {
  if (response == 'valid') {
    // do something if the form input is valid
  } else {
    $('#error-container').html(response); // update the error message container
  }
}

    });
  });
});
</script>

</body>
</html>
