<?php
	include 'header.php';
?>

<?php
	session_start();
	$_SESSION['isLogged']=false;
	if($_POST ) {
		$username=trim($_POST['username']);
		$pass=trim($_POST['pass']);	
		$db_connect=mysqli_connect('localhost', 'teamwork', 'teamwork', 'BURNT-ORANGE');
		if(!$db_connect) {
			echo 'Databases connect error!';
		}
		$query="SELECT * FROM users WHERE username='".$username."' AND password='".$pass."'";
		$insert_query=mysqli_query($db_connect,$query);
		$rows=mysqli_num_rows($insert_query);
		if(!$insert_query) {
			echo "error";
			echo mysqli_error($db_connect);
		}
		else {			
			if($rows>0) {				
				$_SESSION['isLogged']=true;						
			}
			else {
				echo "Грешно потребителско име или парола";
			}			
		}
	}
	if($_SESSION['isLogged']) {
		$query_pic="SELECT * FROM users WHERE username='".$username."'";
		$pic=mysqli_query($db_connect, $query_pic);
		$res=$pic->fetch_assoc();
		echo "
			<img src='".$res["photos"]."' width='50' height='50'/>
		";		
		echo $username;
	}
	else {
		echo "<form method='POST'>
		<label>Username</label>
		<input type='text' name='username'/>
		<label>Password</labeL></label>
		<input type='text' name='pass'/>
		<input type='submit' value='Submit' />		
	</form>
	<a href='Sign_UP.php''>Регистрация</a>";
	}
	?>
<?php
	include 'footer.php';
?>
