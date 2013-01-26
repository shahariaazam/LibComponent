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
                if ($_FILES['ImgName']['size'] < 1.049e+6)
                {
                    if ($_FILES['ImgName']['type'] == 'image/jpeg' || $_FILES['ImgName']['type'] == 'image/png' || $_FILES['ImgName']['type'] == 'image/gif')
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
                        $result = "Please select jpg,png,gif image";
                        return $result;
                    }
                }
                else
                {
                    $result = "Image must me less the 1 MB";
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
    function SizeLimit($maximumSize = null)
    {

    }

    /**
     * @param null $type
     *
     * @return bool
     * @TODO check type of Image through checking Uploaded document's MIME type
     */
    function ImageType($ImageFile = null, array $allowedType = null)
    {
        if(!empty($ImageFile))
        {
            $type=getimagesize($ImageFile);
            return $type['mime'];
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
        //If the directory is not valid then return false
        if(!is_dir($path))
        {
            return false;
        }
        if($this->DirectoryPermission($path) === false)
        {
            return false;
        }
        return true;
    }

    /**
     * @param null $Directory
     *
     * @return bool
     */
    function DirectoryPermission($Directory = null)
    {
        //return false if Directory is not writable
        if(!is_writable($Directory))
        {
            return false;
        }
        return true;
    }
}