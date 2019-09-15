<?php
	include 'inc/header.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body = $fm->validation($_POST['body']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body  = mysqli_real_escape_string($db->link, $body);

		$error = "";

		if(empty($fname)){
			$error = "First Name Must not be empty!";
		}elseif(empty($lname)){
			$error = "Last Name Must not be empty!";
		}elseif(empty($email)){
			$error = "E-mail Must not be empty!";
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Invalid Email Address!";
		}elseif(empty($body)){
			$error = "Message Field Must not be empty!";
		}else{
			$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";
            $insert_page = $db->insert($query);
            if($insert_page){
                $msg = "Message Sent Successfully.";
            } else{
                $error = "Message Not Sent!";
            }
		}
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<h2>Contact Us</h2>
			<?php 
				if(isset($error)){
					echo "<span style='color:red;'>".$error."</span>";
				}
				if(isset($msg)){
					echo "<span style='color:green;'>".$msg."</span>";
				}
			?>
			<form action="contact.php" method="POST">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
						<input type="text" name="firstname" placeholder="Enter first name"/>
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
						<input type="text" name="lastname" placeholder="Enter Last name"/>
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
						<input type="email" name="email" placeholder="Enter Email Address"/>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
						<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="submit" name="submit" value="Send"/>
						</td>
					</tr>
				</table>
			<form>				
		</div>
	</div>


<?php 
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>