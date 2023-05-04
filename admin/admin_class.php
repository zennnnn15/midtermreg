<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."' and type= 1 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."'  and type= 2 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($cpass) && !empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	public function save_event(){
		extract($_POST);
		$event_data = "";
		foreach($_POST as $k => $v){
		  if(!in_array($k, array('id', 'subevents')) && !is_numeric($k)){
			if(empty($event_data)){
			  $event_data .= " $k='$v' ";
			}else{
			  $event_data .= ", $k='$v' ";
			}
		  }
		}
		$event_data .= ", status='1' ";
	  
		if(empty($id)){
		  $save_event = $this->db->query("INSERT INTO events SET $event_data");
		  $event_id = $this->db->insert_id;
		}else{
		  $save_event = $this->db->query("UPDATE events SET $event_data WHERE id = $id");
		  $event_id = $id;
		}
	  
		if($save_event){
		  // Save subevents
		  $existing_subevents = array();
		  $subevents_qry = $this->db->query("SELECT * FROM event_sub WHERE idEvent = $event_id");
		  while($row = $subevents_qry->fetch_assoc()){
			$existing_subevents[] = $row['eventsubName'];
		  }
	
		  if(!empty($subevents)){
			$subevents_arr = json_decode($subevents); // decode JSON string
	
			// Delete old subevents that are not in the new subevents list
			$old_subevents = array_diff($existing_subevents, $subevents_arr);
			if(!empty($old_subevents)){
			  $old_subevents_str = "'" . implode("','", $old_subevents) . "'";
			  $delete_subevents = $this->db->query("DELETE FROM event_sub WHERE idEvent = $event_id AND eventsubName IN ($old_subevents_str)");
			  if(!$delete_subevents){
				// Rollback the event insert/update
				if(empty($id)){
				  $this->db->query("DELETE FROM events WHERE id = $event_id");
				}
				return 0;
			  }
			}
	
			// Insert new subevents that are not in the existing subevents list
			$new_subevents = array_diff($subevents_arr, $existing_subevents);
			if(!empty($new_subevents)){
			  $new_subevent_values = array();
			  foreach($new_subevents as $subevent){
				$subevent_name = $this->db->real_escape_string($subevent);
				$new_subevent_values[] = "('$subevent_name', $event_id)";
			  }
			  $new_subevent_values_str = implode(',', $new_subevent_values);
			  $save_new_subevents = $this->db->query("INSERT INTO event_sub (eventsubName,idEvent) VALUES $new_subevent_values_str");
			  if(!$save_new_subevents){
			  // Rollback the event insert/update
			  if(empty($id)){
			  $this->db->query("DELETE FROM events WHERE id = $event_id");
			  }
			  return 0;
			  }
			  }
			  }else{
			  // Delete all subevents if subevents list is empty
			  $delete_all_subevents = $this->db->query("DELETE FROM event_sub WHERE idEvent = $event_id");
			  if(!$delete_all_subevents){
			  // Rollback the event insert/update
			  if(empty($id)){
			  $this->db->query("DELETE FROM events WHERE id = $event_id");
			  }
			  return 0;
			  }
			  }
			  return 1;
			  }
			  return 0;
			  }
	
	
	  
	
	function update_event_stats(){
		extract($_POST);
			$save = $this->db->query("UPDATE events set status = $status where id = $id");
			if($save)
				return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_attendee(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','status')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(isset($status)){
					$data .= ", status=1 ";
		}else{
					$data .= ", status=0 ";
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO attendees set $data");
		}else{
			$save = $this->db->query("UPDATE attendees set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_attendee(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM attendees where id = $id");
		if($delete){
			return 1;
		}
	}
	function assign_registrar(){
		extract($_POST);
		$uids = array();
		foreach ($user_id as $k => $v) {
			$data = " event_id = $event_id ";
			$data .= ", user_id = $v ";
			$ins = $this->db->query("INSERT INTO assigned_registrar set $data");
			if($ins){
				$uids[] = $this->db->insert_id;
			}
		}
		$this->db->query("DELETE FROM assigned_registrar where event_id = $event_id ".(count($uids) > 0 ? " and id not in (".implode(',',$uids).") " : ''));
		return 1;
	}
	function update_attendee_stats(){
		extract($_POST);
			$event_id = $this->db->query("SELECT * FROM attendees where id = $id")->fetch_array()['event_id'];
			$chk = $this->db->query("SELECT * FROM events where id = $event_id")->fetch_array()['status'];
			if($chk == 2){
				return 2;
				exit;

			}
			$save = $this->db->query("UPDATE attendees set status = $status where id = $id");
			if($save)
				return 1;
	}
	

}

