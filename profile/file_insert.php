<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html>
  <head><title>File Upload To Database</title></head>
  <body>
  <h2>Please Choose a File and click Submit</h2>
  <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" class="form-inline">
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
  <div><input name="userfile" type="file" class="form-control" /></div>
  <div><input type="submit" value="Submit" /></div>
  </form>

</body></html>
<?php
/*** check if a file was submitted ***/
if(!isset($_FILES['userfile']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try    {
        upload();
		header("Location:profile.php");
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }
    }

function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;


    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        $dbh = new PDO("mysql:host=localhost;dbname=sam", 'root', '');

                /*** set the error mode ***/
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
        $stmt = $dbh->prepare("update  user set picture=? where id='1'");

        /*** bind the params ***/
        $stmt->bindParam(1, $imgfp, PDO::PARAM_LOB);
      
        /*** execute the query ***/
        $stmt->execute();
        }
    else
        {
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}
?>