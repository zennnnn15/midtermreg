<?php
include 'database/dbcon.php';

// retrieve the form data from the AJAX request
$field_name = isset($_POST['fieldName']) ? $_POST['fieldName'] : null;
$field_value = isset($_POST['fieldValue']) ? $_POST['fieldValue'] : null;
$formID = isset($_POST['formID']) ? $_POST['formID'] : null;

// check that required values are present
if (!$field_name || !$field_value || !$formID) {
  echo 'Error: Required field missing.';
  exit;
}

// perform the validation
$errors = array();
$get_fieldDetails = "SELECT * FROM field WHERE fieldName = '$field_name' AND formID = '$formID'";
$fieldDetails = mysqli_query($con, $get_fieldDetails);
if (mysqli_num_rows($fieldDetails) > 0) {
  $fieldData = mysqli_fetch_assoc($fieldDetails);
  $field_type = $fieldData['fieldType'];

  switch ($field_type) {
    case 'text':
    case 'textarea':
      if (empty($field_value)) {
        $errors[] = 'Please enter a value.';
      }
      break;
    case 'number':
      if (!is_numeric($field_value)) {
        $errors[] = 'Please enter a valid number.';
      }
      break;
    case 'radio':
      if (empty($field_value)) {
        $errors[] = 'Please select an option.';
      }
      break;
    case 'date':
    case 'time':
      if (empty($field_value)) {
        $errors[] = 'Please enter a value.';
      } else {
        $date_format = ($field_type == 'date') ? 'Y-m-d' : 'H:i:s';
        $date_obj = DateTime::createFromFormat($date_format, $field_value);
        $date_errors = DateTime::getLastErrors();
        if ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
          $errors[] = 'Please enter a valid date/time.';
        }
      }
      break;
  }
}

// return the validation result to the jQuery function
if (empty($errors)) {
  echo 'valid';
} else {
  echo implode('<br>', $errors);
}


?>
