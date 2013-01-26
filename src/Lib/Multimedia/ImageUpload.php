<?php
/*
 * Image Upload Class
 */
class ImageUpload
{
    /**
     * @param null $path            Custom path where uploaded image will be stored
     * @param null $maximumSize     Custom Maximum size in (Bytes) will be passed.
     * @param array $allowedType    Custom extension type (JPG|GIF|PNG)
     * @param null $option          Extra options as array where we can define 'Image File Name', blah blah blah
     *
     * @return string
     */
    public function ImgUpload($path=null, $maximumSize=null, array $allowedType=null, $option=null)
    {
        if (isset($_POST['submit']))
        {
            if (!empty($_FILES['ImgName']['name']))
            {
                if ($x=self::SizeLimit($_FILES['ImgName']['size'],$maximumSize)== true)
                {
                    if ($x=self::ImageType($_FILES['ImgName']['type'],$allowedType) == true)
                    {
                        if (move_uploaded_file($_FILES['ImgName']['tmp_name'], $_FILES['ImgName']['name']))
                        {
                            $result = 'Image has been Uploaded';
                            return $result;
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        $result="Please Select ";
                        if($allowedType != null){
                            foreach($allowedType as $allowedTypes)
                            {
                                $result.= "/".$allowedTypes;
                            }
                            return $result." image";
                        }
                        else
                        {
                            return $result." jpg/png/gif image";
                        }
                    }
                }
                else
                {
                    $result = "Image must me less then". $maximumSize. " byte";
                    return $result;
                }
            }
            else
            {
                $result = 'You do not select any file';
                return $result;
            }
        }
    }

    /**
     * @param $Size
     * @TODO    Examine image size and then implement it to the main function
     */
    function SizeLimit($ImgSize,$maximumSize = null)
    {
       if($maximumSize != null){
           if($ImgSize < $maximumSize){
               return true;
           }
           else
           {
               return false;
           }
       }
       else
       {
           return true;
       }
    }

    /**
     * @param null $type
     *
     * @return bool
     * @TODO check type of Image through checking Uploaded document's MIME type
     */
    function ImageType($ImgType,array $allowedType = null)
    {
        if($allowedType != null){
            $i=0;
            while($i<sizeof($allowedType))
            {
                if($ImgType=="image/".$allowedType[$i]){
                    return true;
                    break;
                }
                $i++;
            }
            return false;
        }
        else
        {
            if($ImgType=='image/jpg' || $ImgType=='image/png' || $ImgType=='image/gif')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * @param null $path
     *
     * @return bool
     * @TODO Check the given @path is valid or not
     */
    function CheckPath($path = null)
    {
        return true;
    }
}