
		
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
							header("Content-Type: application/vnd.ms-excel");
							header("Content-Disposition: attachment; filename=\"$filename\" ");
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

