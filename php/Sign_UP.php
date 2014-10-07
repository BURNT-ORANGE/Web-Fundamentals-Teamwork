<?php
	include 'header.php';
?>
	<?php
	mb_internal_encoding("UTF-8");
		if($_POST) {
			print_r($_FILES);
			$error=false;
			$username=trim($_POST['username']);
			$pass=trim($_POST['pass']);
			if(mb_strlen($username)<4) {
				echo "Потребителското име трябва да бъде по-голямо от 4 символа.";
				$error=true;
			}
			if(mb_strlen($pass)<6) {
				echo "Паролата трябва да бъде по-голямо от 4 символа.";
				$error=true;
			}
			if(count($_FILES)>0){
				if(move_uploaded_file($_FILES['picture']['tmp_name'], 'Photos'.DIRECTORY_SEPARATOR.$_FILES['picture']['name'])){
					if(!$error) {
						$path="Photos".DIRECTORY_SEPARATOR.$_FILES['picture']['name'];
						$connect=mysqli_connect('localhost', 'teamwork', 'teamwork', 'BURNT-ORANGE');
						if(!$connect) {
							echo "Database connect error";
						}
						$query_brows="SELECT * FROM users WHERE username='".$username."' AND password='".$pass."'";		
						$brows=mysqli_query($connect, $query_brows);				
						$row=mysqli_num_rows($brows);
						if($row==0) {
							$query_insert="INSERT INTO users(username,password,photos) VALUES('".$username."','".$pass."','".$path."')";
							$insert=mysqli_query($connect, $query_insert);	
						}
					}
				}
			}
		}
	?>
	<form method="POST" enctype="multipart/form-data">
		<label>Потребителско име</label>
		<input type="text" name="username"/>
		<label>Парола</label>
		<input type="password" name="pass"/>
		<label>Снимка</label>
		<input type="file" name="picture"/>
		<input type="submit" values="Регистрация"/>		
	</form>	
<?php
	include 'footer.php';
?>