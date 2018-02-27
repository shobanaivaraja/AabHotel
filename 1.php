<?php
			
set_time_limit(0); 
		
$link  =  mysqli_connect("localhost","root","","sam") ;		
		
		
		
		
 //define a maxim size for the uploaded images
define ("MAX_SIZE","500"); 
// define the width <strong class="highlight"><vb_highlight>and</strong></vb_highlight> height for the thumbnail
 // note that theese dimmensions are considered the maximum dimmension <strong class="highlight"><vb_highlight>and</strong></vb_highlight> are not fixed, 
 // because we have to keep the <strong class="highlight">image</strong> ratio intact or it will be deformed
 define ("WIDTH","150");  //set here the width you want your thumbnail to be
 define ("HEIGHT","120");  //set here the height you want your thumbnail to be.
		
 // this is the function that will create the thumbnail <strong class="highlight">image</strong> from the uploaded <strong class="highlight">image</strong>
// the <strong class="highlight">resize</strong> will be done considering the width <strong class="highlight"><vb_highlight>and</strong></vb_highlight> height defined, but without deforming the <strong class="highlight">image</strong>
 function make_thumb($img_name,$filename,$new_w,$new_h)
{
//get <strong class="highlight">image</strong> extension.
$ext=getExtension($img_name);
//creates the new <strong class="highlight">image</strong> using the appropriate function from gd library
if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
$src_img=imagecreatefromjpeg($img_name);
		
if(!strcmp("png",$ext))
$src_img=imagecreatefrompng($img_name);
			
if(!strcmp("gif",$ext))
$src_img=imagecreatefromgif($img_name);
		
//gets the dimmensions of the <strong class="highlight">image</strong>
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
		
 // next we will calculate the new dimmensions for the thumbnail <strong class="highlight">image</strong>
// the next steps will be taken: 
// 	1. calculate the ratio by dividing the old dimmensions <strong class="highlight">with</strong> the new ones
//	2. if the ratio for the width is higher, the width will remain the one define <strong class="highlight">in</strong> WIDTH variable
//		<strong class="highlight"><vb_highlight>and</strong></vb_highlight> the height will be calculated so the <strong class="highlight">image</strong> ratio will not change
//	3. otherwise we will use the height ratio for the <strong class="highlight">image</strong>
// as a result, only one of the dimmensions will be from the fixed ones
$ratio1=$old_x/$new_w;
$ratio2=$old_y/$new_h;
if($ratio1>$ratio2)	{
$thumb_w=$new_w;
$thumb_h=$old_y/$ratio1;
}
else	{
$thumb_h=$new_h;
$thumb_w=$old_x/$ratio2;
}
		
// we create a new <strong class="highlight">image</strong> <strong class="highlight">with</strong> the new dimmensions
			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
// <strong class="highlight">resize</strong> the big <strong class="highlight">image</strong> to the new created one
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		
// output the created <strong class="highlight">image</strong> to the file. Now we will have the thumbnail into the file named by $filename
if(!strcmp("png",$ext))
imagepng($dst_img,$filename); 
else
imagejpeg($dst_img,$filename);
				
if (!strcmp("gif",$ext))
imagegif($dst_img,$filename); 
		
//destroys source <strong class="highlight"><vb_highlight>and</strong></vb_highlight> destination images. 
imagedestroy($dst_img); 
imagedestroy($src_img); 
 }
	
 // This function reads the extension of the file. 
 // It is used to determine if the file is an <strong class="highlight">image</strong> by checking the extension. 
function getExtension($str) {
 $i = strrpos($str,".");
 if (!$i) { return ""; }
 $l = strlen($str) - $i;
 $ext = substr($str,$i+1,$l);
 return $ext;
 }
 // This variable is used as a flag. The value is initialized <strong class="highlight">with</strong> 0 (meaning no error found) 
 //and it will be changed to 1 if an error occures. If the error occures the file will not be uploaded.
 $errors=0;
 // checks if the form has been submitted
 if(isset($_POST['Submit']))
 {
 //reads the name of the file the user submitted for uploading
$image=$_FILES['cons_image']['name'];
// if it is not empty
if ($image) 
{
// get the original name of the file from the clients machine
$filename = stripslashes($_FILES['cons_image']['name']);
				
// get the extension of the file <strong class="highlight">in</strong> a lower case format
$extension = getExtension($filename);
$extension = strtolower($extension);
// if it is not a known extension, we will suppose it is an error, print an error message 
//and will not <strong class="highlight">upload</strong> the file, otherwise we continue
if (($extension != "jpg")  && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))	
{
echo '<h1>Unknown extension!  Please use .gif, .jpg or .png files only.</h1>';
$errors=1;
}
else
{
// get the size of the <strong class="highlight">image</strong> <strong class="highlight">in</strong> bytes
// $_FILES[\'image\'][\'tmp_name\'] is the temporary filename of the file <strong class="highlight">in</strong> which 
//the uploaded file was stored on the server
					$size=getimagesize($_FILES['cons_image']['tmp_name']);
$sizekb=filesize($_FILES['cons_image']['tmp_name']);
		
//compare the size <strong class="highlight">with</strong> the maxim size we defined <strong class="highlight"><vb_highlight>and</strong></vb_highlight> print error if bigger
	
					
$rand= rand(0, 1000);
//we will give an unique name, for example a random number
$image_name=$rand.'.'.$extension;
//the new name will be containing the full path where will be stored (images folder)
$consname="".$image_name;  //change the image/ section to where you would like the original <strong class="highlight">image</strong> to be stored
					$consname2="thumb".$image_name; //change the image/thumb to where you would like to <strong class="highlight">store</strong> the new created thumb nail of the <strong class="highlight">image</strong>
$copied = copy($_FILES['cons_image']['tmp_name'], $consname);
$copied = copy($_FILES['cons_image']['tmp_name'], $consname2);
//we verify if the <strong class="highlight">image</strong> has been uploaded, <strong class="highlight"><vb_highlight>and</strong></vb_highlight> print error instead
if (!$copied) {
echo '<h1>Copy unsuccessfull!</h1>';
$errors=1;
}
else
{
// the new thumbnail <strong class="highlight">image</strong> will be placed <strong class="highlight">in</strong> images/thumbs/ folder
$thumb_name=$consname2	;
// call the function that will create the thumbnail. The function will get as parameters 
//the <strong class="highlight">image</strong> name, the thumbnail name <strong class="highlight"><vb_highlight>and</strong></vb_highlight> the width <strong class="highlight"><vb_highlight>and</strong></vb_highlight> height desired for the thumbnail
						$thumb=make_thumb($consname,$thumb_name,WIDTH,HEIGHT);
												
$sql="update `test_image` set `image`='$copied' where `id`=4";
$query = mysqli_query($link,$sql);
}
}	
}
}
					
 //If no errors registred, print the success message <strong class="highlight"><vb_highlight>and</strong></vb_highlight> how the thumbnail <strong class="highlight">image</strong> created
if(isset($_POST['Submit']) && !$errors) 
 {
echo "<h5>Thumbnail created Successfully!</h5>";
echo '<img src="'.$thumb_name.'">';

}
		 
echo "<form name=\"newad\" method=\"post\" enctype=\"multipart/form-data\"  action=\"\">";
echo "<input type=\"file\" name=\"cons_image\"  >";
echo "<input name=\"Submit\" type=\"submit\"  id=\"image1\" value=\"Upload\" />";
 echo "</form>";
		 
?>