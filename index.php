<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
	<title>DIAAG Assignment</title>
</head>
<body>
	<h1>DIAAG Assignment</h1>
	<h2>1. Generate a database</h2>
	
	   <?php 

		$mysql_host = "localhost";
		$mysql_database = "programming_assignment_db";
		$mysql_user = "root";
		$mysql_password = "root";

		# MySQL with PDO_MYSQL  
		$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
		$query = file_get_contents("testDatabase.sql");
		$stmt = $db->prepare($query);
		if ($stmt->execute())
		     echo "Success";
		else 
		     echo "Fail";

	   ?>

	<h3>Access Database</h3>

	
	<p>Access MySQL Database</p>
		<?php include "scripts/con.php"; ?>
		<i><?php if($con){ echo "Successfully Conected to Database"; }  ?></i>


	<h3>Access JsonPlaceHolder</h3>

		<p>Access JsonPlaceHolder with script : Print at console: <a href="https://jsonplaceholder.typicode.com/users">https://jsonplaceholder.typicode.com/users</a></p>
		
		<script>
		fetch('https://jsonplaceholder.typicode.com/users')
		  .then(response => response.json())
		  .then(json => console.log(json))
		</script>

	<p>Access JsonPlaceHolder with PHP</p>

		<?php
		//get JSON Objects from API
		$response = file_get_contents('https://jsonplaceholder.typicode.com/users');

		//decode Json
		$decoded = json_decode($response);

		for ($i = 0 ; $i < count($decoded); $i++){   
		//select name and username
		$name = $decoded[$i]->name;
		$username = $decoded[$i]->username;		
		$email = $decoded[$i]->email;	
 		$email_lower = strtolower($email);

		//select latitude and longitude fields
		$lat = $decoded[$i]->address->geo->lat;
		$lng = $decoded[$i]->address->geo->lat;	

		echo "<br>---- Decoded information below: ----".$i."-<br>";
		var_dump($name);
		var_dump($username);
		var_dump($email_lower);
		var_dump($lat);
		var_dump($lng);
		//var_dump($selected);
		}
		?>

	<h2>2. Fill the missing data elements</h2>
	
		<p>Perform case standarization table users</p>

		<?php 
		
		include "scripts/con.php";
		$sql = "SELECT * FROM `users` ";
		$result = mysqli_query($con,$sql);

		  // Return the number of rows in result set
		$rowcount= mysqli_num_rows($result);

		echo "Number of elements:".$rowcount;
		echo "<br>Standarized:";

	  	while($row = mysqli_fetch_array($result)){ 
			
				$user_id = $row["id"];
				$user_name = $row["name"];
				$user_username = $row["username"];
				$user_email = $row["email"];
				$user_address_geo_lat = $row["address__geo__lat"];
				$user_address_geo_lng = $row["address__geo__lng"];

				if($user_email != ''){

					$temp = $user_email;
					$lower = strtolower($temp);

					echo "<br> ".$user_id." - standarized - >".$lower;
					 
					$update_sql = "UPDATE users SET email='$lower' WHERE id = $user_id";
					$upd = mysqli_query($con,$update_sql);

				} else { echo " monster ";}	
			}
		mysqli_close($con);
	 ?>
		
	<p>Perform case standarization table post_comments</p>

		<?php 
		
		include "scripts/con.php";
		$sql = "SELECT * FROM `post_comments` ";
		$result = mysqli_query($con,$sql);

		  // Return the number of rows in result set
		$rowcount= mysqli_num_rows($result);

		echo "Number of elements:".$rowcount;
		echo "<br>Standarized:";

	  	while($row = mysqli_fetch_array($result)){ 
			
				$pc_id = $row["id"];
				$pc_post_id = $row["postId"];
				$pc_name = $row["name"];
				$pc_email = $row["email"];
		
				if($user_email != ''){

					$temp = $pc_email;
					$lower = strtolower($temp);
					 
					$update_sql = "UPDATE post_comments SET email='$lower' WHERE id = $pc_id";
					$upd = mysqli_query($con,$update_sql);

					echo "<br> ".$pc_id." standarized - > ".$lower;

				} else { echo " monster ";}	
			}
		mysqli_close($con);
	 ?>

		<p>Fill users table</p>

				<?php 
						include "scripts/con.php"; 
						$sql = "SELECT * FROM `users` ";
						$result = mysqli_query($con,$sql);

						  // Return the number of rows in result set
						$rowcount= mysqli_num_rows($result);

						echo "Number of elements:".$rowcount;
					 
					  	while($row = mysqli_fetch_array($result)){ 
							
								$user_id = $row["id"];
								$user_name = $row["name"];
								$user_username = $row["username"];
								$user_email = $row["email"];
								$user_address_geo_lat = $row["address__geo__lat"];
								$user_address_geo_lng = $row["address__geo__lng"];

								if($user_email != ''){

									$temp = $user_email;
									$lower = strtolower($temp);

									echo "<br> ".$user_id." - ".$lower;
									
										$response = file_get_contents('https://jsonplaceholder.typicode.com/users');

										//decode Json
										$decoded = json_decode($response);

										for ($i = 0 ; $i < $rowcount; $i++){   
										//select name and username
										$name = $decoded[$i]->name;
										$username = $decoded[$i]->username;		
										$email = $decoded[$i]->email;	
								 		$email_lower = strtolower($email);

										//select latitude and longitude fields
										$lat = $decoded[$i]->address->geo->lat;
										$lng = $decoded[$i]->address->geo->lng;	

										$update_sql = "UPDATE users SET username='$username', address__geo__lat = $lat , address__geo__lng = $lng WHERE email='$email_lower'";
										$upd = mysqli_query($con,$update_sql); 

										}
										
									

								} else { echo " monster ";}	
							}
						mysqli_close($con);
				?>


			<p>Fill the post table</p>


				<?php 
						include "scripts/con.php"; 
						$sql = "SELECT * FROM `posts`";
						$result = mysqli_query($con,$sql);

						  // Return the number of rows in result set
						$rowcount= mysqli_num_rows($result);

						echo "Number of elements:".$rowcount;
					 
					  	while($row = mysqli_fetch_array($result)){ 
							
								

								if($rowcount > 0){

										$response = file_get_contents('https://jsonplaceholder.typicode.com/posts');

										//decode Json
										$decoded = json_decode($response);

										for ($i = 0 ; $i < $rowcount; $i++){   
										//select name and username
										$id = $decoded[$i]->id;
										$userId = $decoded[$i]->userId;		
										$title = $decoded[$i]->title;
										$body = $decoded[$i]->body;		
								 		 
										$update_sql = "UPDATE posts SET userId='$userId' WHERE id='$id'";
										$upd = mysqli_query($con,$update_sql); 


										}
											
									

								} else { echo " turtle ";}	

								$post_userId = $row["userId"];
								$post_id = $row["id"];
								$post_title = $row["title"];
								echo "<br> id: ".$post_id." / user id: ".$post_userId." / title:".$post_title."";
						}
					mysqli_close($con);
				?>
		



		<p>email count in post_comments table</p>
 
				<?php 
						include "scripts/con.php"; 

						// selects goups larger than 3 of the same email in the post_comments table
						$sql = "SELECT COUNT(pc.email)AS c,p.id as post_id, p.userId as post_user_id ,pc.id AS post_comment_id, pc.postId AS post_comment_post_id , pc.email,u.id AS user_id, u.name AS user_name, u.username, u.address__geo__lat, u.address__geo__lng FROM post_comments as pc RIGHT JOIN posts as p ON pc.postId=p.id INNER JOIN users AS u ON pc.email=u.email GROUP BY pc.email HAVING (c >3)";

						// selects goups larger than 3 of the same email in the post_comments table
						//$sql = "SELECT DISTINCT(email), COUNT(email) as c FROM `post_comments` GROUP BY email HAVING (c >= 3 )";


						//$sql = "SELECT COUNT(DISTINCT(email)) AS count, postId as pid , email FROM `post_comments` GROUP BY email";
						
						//$sql = "SELECT postId, email,COUNT(*) as count FROM post_comments INNER JOIN post ON 'post_comments.postId' = 'posts.userId' GROUP BY email HAVING (count >= 3)";

						//$sql = "SELECT COUNT(DISTINCT(pc.email)), pc.email FROM post_comments AS pc JOIN posts AS p ON pc.postId = p.id JOIN users AS u ON pc.email != u.email GROUP BY pc.postId ";

						$result = mysqli_query($con,$sql);

						  // Return the number of rows in result set
						$rowcount= mysqli_num_rows($result);

						echo "Number of elements:".$rowcount;
					 
					  	while($row = mysqli_fetch_array($result)){ 
								$post_id = $row["post_id"];
								$pc_id = $row["post_comment_post_id"];
								$pc_email = $row["email"];
								$u_lat = $row["address__geo__lat"];
								$u_lng = $row["address__geo__lng"];
						
								//$post_email = $row["email"];
								//$comment_post_id = $row["postId"]; 
								//$comment_id = $row["id"];
								//$comment_post_id = $row["postId"];

								echo "<br> post_id: ".$post_id." /  pc_id: ".$pc_id."  email: ".$pc_email."  Latitude: ".$u_lat."  Longitude: ".$u_lng."   ";
										 
							}

							$filename = "export_excel.xls";
							//header("Content-Type: application/vnd.ms-excel");
							//header("Content-Disposition: attachment; filename=\"$filename\" ");
							$isPrintHeader=false;

							if(!empty($result)){

								foreach($result as $row){

									if(! $isPrintHeader){

										echo implode("\t", array_keys($row))."\n";
										$isPrintHeader = true;
									}
									echo implode("\t", array_values($row))."\n";

								}


							}
							exit();

						mysqli_close($con);
				?>


	<h3>Integrate Placeholder information into database</h3>

		<p>Write logic to integrate the database with placeholder code</a></p>
	
	<ul>
		<li>Users</li>
		<li>User Posts</li>
		<li>Post Comments</li>
	</ul>

	<h2>3. Return a Report of Commenters Export to an Excel File</h2>
	
		<p><i>A commenter has posted 3 or more times on posters post</i></p>	

		<p>Report should contain:</p>	
	<ul>
		<li>A poster has posted</li>
		<li>User Posts</li>
		<li>Post Comments</li>
	</ul>

	<h2>4. Build an API on top of the database</h2>
		<p>Search by</p>
			<ul>
				<li>Search by username</li>
				<li>Search by userID</li>
			</ul>

		<p>Format:</p>
			<ul>
				<li>Response Format</li>
				<li>Response Structure</li>	
			</ul>

	<h2>5. Write Client Application</h2>
		<p>Uses API to allow searching for:</p>
	
			<ul>
				<li>Search Box (poster)</li>
				
			</ul>
		<p>Response should have format:</p>
	
	<ul>
		<li>Username</li>
		<li>Distance</li> <p><i> Ask question about the reference location. </i></p>
		<li>Times Commented</li>
	</ul>

</body>
</html>
