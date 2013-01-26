<?php
/*
 * Image Upload Class
 */
class ImageUpload{
    public function ImgUpload(){
        if(isset($_POST['submit']))
        {
            if(!empty($_FILES['ImgName']['name']))
            {
                if($_FILES['ImgName']['size']<1.049e+6)
                {
                    if($_FILES['ImgName']['type']=='image/jpeg' || $_FILES['ImgName']['type']=='image/png' || $_FILES['ImgName']['type']=='image/gif')
                    {
                        if(move_uploaded_file($_FILES['ImgName']['tmp_name'],$_FILES['ImgName']['name']))
                        {
                            echo 'Image has been Uploaded';
                        }
                        else
                        {
                            echo 'Sorry!!! Something happened';
                        }
                    }
                    else{
                        echo "Please select jpg,png,gif image";
                    }
                }
                else
                {
                    echo "Image must me less the 1 MB";
                }
            }
            else
            {
                 return 'You do not select any file';
            }
        }
    }
}