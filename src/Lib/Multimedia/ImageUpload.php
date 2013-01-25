<?php
/*
 * Imaage Upload Class
 */
class ImageUpload{
    public function ImgUpload(){
        if(isset($_POST['submit']))
        {
            if(!empty($_FILES['ImgName']['name']))
            {
                if(move_uploaded_file($_FILES['ImgName']['tmp_name'],$path."/".$_FILES['ImgName']['name'])){
                    echo 'ok';
                }else{
                    echo 'mm';
                }
                // $ImgName=$_FILES['ImgName']['name'];
            }
            else
            {
                 return 'You do not select any file';
            }
        }
    }
}