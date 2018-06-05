<!DOCTYPE html>
<html>
<head>
<title>Film Collection</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="appIndex.css">
</head>
<style>
body{
	background-image:url("filmwp1.jpg");
	background-size:cover;
	color:#303030;
}
.container{
	background:rgba(255,219,88, 0.6);
	font-family:Segoe UI Light;
	font-size:15px;
	font-weight:bold;
	margin-top:60px;
	}
hr{
	border:5px dashed #303030;
	margin-left:40px;
	margin-right:40px;
}
h1{
	font-family:Segoe Script;
	font-size:5em;
	text-align:center;
}
.row{
	margin-left:20px;
	margin-right:20px;
}
#left{
	border-right: 1px solid #303030;
}
input[type=text]{
	width:250px;
	height:40px;
	margin-bottom:5px;
	margin-top:5px;
	padding:5px;
}
input[type=submit]{
	width:200px;
	height:40px;
	margin-left: 20px;
}
h2{
	text-align:left;
}
#search{
	margin-left:400px;
	position:absolute;
	top:10px;
	right:10px;
	margin-bottom:30px;
}
#radioitem{
	text-align:right;
	margin-right:40px;
}
#myInfo{
	margin-top: 10px;
	text-align:right;
	font-size:20px;
	background:rgba(0,0,0,0.8);
	text-align:center;
	color:rgb(255,219,88);
}
.collection{
	padding-bottom:30px;
	border-bottom:1px solid black;
}
.display{
	border-bottom:1px solid #303030;
	background:rgba(0,0,0,0.8);
	color:rgb(255,219,88);
	padding-left:30px;
}
</style>
<body>
<div class="container">
<hr/>
<h1>Film Collection</h1>
<hr/>
<div class="row">
  <div class="col-xs-6 col-sm-8 col-lg-4" id="left">
  <form action="" method="post">
  <input type="text" name="title" placeholder="Enter Title"/><br/>
<input type="text" name="actor" placeholder="Enter main Actor"/><br/>

<input type="radio" name="genre" value="Action"/> Action
<input type="radio" name="genre" value="Comedy"/> Comedy
<input type="radio" name="genre" value="Science Fiction"/> Science Fiction<br/>
<input type="radio" name="genre" value="Horror"/> Horror
<input type="radio" name="genre" value="Drama"/> Drama
<input type="radio" name="genre" value="Animation"/> Animation<br/>
<input type="radio" name="genre" value="Romance"/> Romance
<input type="radio" name="genre" value="Thriller"/> Thriller<br/>

<input type="submit" name="save" value="save"/>
</form>
<?php
$conn = @mysqli_connect('localhost', 'root', '', 'student');
if(!$conn){
	echo "Error: ".mysqli_connect_error();
	exit;
}else{
	if(isset($_POST['save'])){
	$ins = 'INSERT INTO movies(mov_name,mov_actor,mov_genre)VALUES("'.$_POST["title"].'","'.$_POST["actor"].'","'.$_POST["genre"].'")';
	$query = mysqli_query($conn, $ins);
	if($query){
		echo "Inserted";
		header("location: movie.php");
		exit;
	}else{
		echo "error".mysqli_error($conn);
	}
	mysqli_close($conn);
	}
}
?>
  </div>
  <div class="col-xs-6 col-sm-4 col-lg-8" id="right">
  <div class="collection">
    <h2>Collection</h2>
	<form action="" method="post">
	<div id="search">
  <div id="radioitem">
  <input type="radio" name="Search" value="title"/> Title
<input type="radio" name="Search" value="actor"/> Actor
<input type="radio" name="Search" value="genre"/> Genre<br/>
  
  </div>
  
  <input type="text" placeholder="Search" name="typeSearch"/>
  <button type="submit" name="searchbtn"><span class="glyphicon glyphicon-search"></span></button>
  </div>
	</form>
  </div>
  <div id="body">
  <?php
  if(isset($_POST['searchbtn'])){
	  if($_POST['Search'] == "title" ){
		  $sel1 = "SELECT * FROM movies WHERE mov_name = '".$_POST['typeSearch']."'";
		  if($result2 = mysqli_query($conn, $sel1)){
			if(mysqli_num_rows($result2) > 0){
				while($row = mysqli_fetch_array($result2)){
					echo "<p class='display'>";
					echo $row['mov_name'];
					echo "<br/>";
					echo $row['mov_actor'];
					echo "<br/>";
					echo $row['mov_genre'];
					echo "<br/>";
					echo "</p>";
					}
			}else{
				echo "There are no movies under that title added";
			}
		}
		mysqli_close($conn);
	  }elseif($_POST['Search'] == "actor" ){
		  $sel2 = "SELECT * FROM movies WHERE mov_actor = '".$_POST['typeSearch']."'";
		  if($result3 = mysqli_query($conn, $sel2)){
			if(mysqli_num_rows($result3) > 0){
				while($row3 = mysqli_fetch_array($result3)){
					echo "<p class='display'>";
					echo $row3['mov_name'];
					echo "<br/>";
					echo $row3['mov_actor'];
					echo "<br/>";
					echo $row3['mov_genre'];
					echo "<br/>";
					echo "</p>";
					}
			}else{
				echo "There are no movies under that actor added";
			}
		}	  
	  }elseif($_POST['Search'] == "genre" ){
		  $sel3 = "SELECT * FROM movies WHERE mov_genre = '".$_POST['typeSearch']."'";
		  if($result4 = mysqli_query($conn, $sel3)){
			if(mysqli_num_rows($result4) > 0){
				while($row4 = mysqli_fetch_array($result4)){
					echo "<p class='display'>";
					echo $row4['mov_name'];
					echo "<br/>";
					echo $row4['mov_actor'];
					echo "<br/>";
					echo $row4['mov_genre'];
					echo "<br/>";
					echo "</p>";
					}
			}else{
				echo "There are no movies under that genre added";
			}
		}
	  }else{
		  $sele2 = "SELECT * FROM movies";
		if($result5 = mysqli_query($conn, $sele2)){
			if(mysqli_num_rows($result5) > 0){
				while($row5 = mysqli_fetch_array($result5)){
					echo "<p class='display'>";
				echo $row5['mov_name'];
				echo "<br/>";
				echo $row5['mov_actor'];
				echo "<br/>";
				echo $row5['mov_genre'];
				echo "<br/>";
				echo "</p>";
				}
			}
		}
		mysqli_close($conn);
	  }
  }else{
		$sele = "SELECT * FROM movies";
		if($result = mysqli_query($conn, $sele)){
			if(mysqli_num_rows($result) > 0){
				while($row2 = mysqli_fetch_array($result)){
					echo "<p class='display'>";
				echo $row2['mov_name'];
				echo "<br/>";
				echo $row2['mov_actor'];
				echo "<br/>";
				echo $row2['mov_genre'];
				echo "<br/>";
				echo "</p>";
				}
			}
		}
		mysqli_close($conn);
	}
  ?>
  </div>
  </div>
</div>
</div>
  <div id="myInfo" class="container">
  <p>&lt; Sheila Wambui Karienye /&gt;</p>
  <p>&lt; sheila.karienye@gmail.com /&gt;</p>
  <p>&lt; https://github.com/wamboe /&gt;</p>
  
  </div>

</body>
</html>
