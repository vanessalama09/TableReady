<?php
    // this code is used to upload photos to the database
    include 'dbConnection.php';
    
    // when the upload button is pressed, the code verifies the file is of the correct type and gathers other information about the file
    // to store in the database
    session_start();
    if (isset($_POST['upload'])){
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                // this code ensures the file isn't too big
                if ($fileSize < 1000000)
                {
                    $fileNameNew = $_SESSION['restaurant_ID']."-".uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'menuuploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                }
                else
                {
                    echo "Your file is too big";
                }

            }
            else{
                echo "There was an error uploading your file";
            }
        }
        else{
            echo "Cannot upload files of this type";
        }

    }

    $path = "menuuploads/";
    $extensions_array = array('jpg', 'jpeg', 'png');

    if(is_dir($path))
    {
        $files = scandir($path);

        // this for loop cycles through all the files in the database and uses echo to display the ones that correspond to the correct restraunt
        for ($i = 0; $i < count($files); $i++)
        {
            if (strpos($files[$i], $_SESSION['restaurant_ID']) !== false) {
                $file = pathinfo($files[$i]);
                $extension = $file['extension'];

                echo "<img src = '$path$files[$i]' style = 'width:100px; height: 150px;'>";
            }
        }
    }

    // the user is quickly redirected back to the dashboard
    header("Location: http://www.localhost/frontend/dashboard.php");
    die();
    
    ?>