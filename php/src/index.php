<?php
    //These are the defined authentication environment in the db service

    // The MySQL service named in the docker-compose.yml.
    $host = 'db';

    // Database use name
    $user = 'MYSQL_USER';

    //database user password
    $pass = 'MYSQL_PASSWORD';

    //database name
    $mydatabase = 'MYSQL_DATABASE';

    $conn = new mysqli($host, $user, $pass, $mydatabase);

    $errors = [];

    $id = 0;
    $first_name = '';
    $last_name = '';
    $gender = '';
    $email = '';
    $bio = '';
    $timestamp = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // validate form
        $first_name= $_REQUEST['first-name'];
        $last_name = $_REQUEST['last-name'];
        $gender = $_REQUEST['gender'];
        $email = $_REQUEST['email'];
        $bio = $_REQUEST['bio'];
        $timestamp = date('Y-m-d H:i:s');
       

        if(!$first_name){
            $errors[] = 'Enter First Name';
        }
        if(!$last_name){
            $errors[] = 'Enter Last Name';
        }
        if(!$gender){
            $errors[] = 'Enter Gender';
        }
        if(!$email){
            $errors[] = 'Enter Email';
        }
    
        if(!$bio){
            $errors[] = 'Enter Bio';
        }

        if(empty($errors)){


            $sql = "INSERT INTO form_details VALUES ('$id','$first_name','$last_name','$gender','$email','$bio','$timestamp')";

            if(mysqli_query($conn, $sql)){
                
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);
            }
            
            $first_name = '';
            $last_name = '';
            $gender = '';
            $email = '';
            $bio = '';
            $timestamp = '';
            $id+=1;
        }
    }

    mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INFO FORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  
  <?php if(!empty($errors)): ?>

    <div class="alert alert-danger">
        <?php foreach($errors as $error):?>
            <div><?php echo $error?></div>
        <?php endforeach;?>
    </div>

  <?php endif;?>
  
  <form method="post" class="container mt-5 extra">
    <h1 class="title">Form Details</h1>

    <div class="mb-3">
        <label for="first-name" class="form-label">First Name</label>
        <input name="first-name" type="text" class="form-control" placeholder="Enter First Name" value="<?php echo $first_name ?>">
    </div>
    
    <div class="mb-3">
        <label for="last-name" class="form-label">Last Name</label>
        <input name="last-name" type="text" class="form-control" placeholder="Enter Last Name" value="<?php echo $first_name ?>">
    </div>
    
    
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <input name="gender" type="text" class="form-control" placeholder="Male | Female | Others" value="<?php echo $gender?>">
    </div>


    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" value="<?php echo $email?>">
        <div class="form-text">We'll never share your email with anyone else.</div>
    </div>


    <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea name="bio" class="form-control" value="<?php echo $bio?>"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mb-200">Submit</button>

</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>