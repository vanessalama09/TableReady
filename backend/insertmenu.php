

<!DOCTYPE html>
<html>
<head>
</head>
<!-- this is the code to call upload.php at a button press and send an image
    this code is mainly for testing purposes and there's a similar copy within the dashboard code -->
<body>
 <div id ="addmenu">
    <form action="upload.php" method ="POST" enctype="multipart/form-data">
        <div>
            <input type="file" name="image" id="image"/>
        </div>
        <div>
            <input type = "submit" name="upload" value="Upload Menu" id="upload"/>
        </div>
    </form>
</div>
</body>
</html>

