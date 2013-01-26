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
	public function ImgUpload($path = null, $maximumSize = null, array $allowedType = null, $option = null)
	{
		if (isset($_POST['submit'])) {
			if (!empty($_FILES['ImgName']['name'])) {
				if ($x = self::SizeLimit($_FILES['ImgName']['size'], $maximumSize) === true) {
					if ($x = self::ImageType($_FILES['ImgName']['type'], $allowedType) === true) {
						if ($x = self::CheckPath($path) === true) {
							if ($x = self::CheckPermission($path) === true) {
								if (move_uploaded_file($_FILES['ImgName']['tmp_name'], $path . $_FILES['ImgName']['name'])) {
									$result = 'Image has been Uploaded';
									return $result;
								} else {
									return false;
								}
							} else {
								return "Directory do not have write permission,";
							}
						} else {
							return "Directory could not found,";
						}
					} else {
						$result = "Please Select ";
						if ($allowedType != null) {
							foreach ($allowedType as $allowedTypes) {
								$result .= "/" . $allowedTypes;
							}
							return $result . " image";
						} else {
							return $result . " jpg/png/gif image";
						}
					}
				} else {
					$result = "Image must me less then" . $maximumSize . " byte";
					return $result;
				}
			} else {
				$result = 'You do not select any file';
				return $result;
			}
		}
	}

	/**
	 * @param $ImgSize               Image size which is selected for upload
	 * @param null $maximumSize      Custom max image size passed
	 * @return bool                  Return true or false
	 */
	function SizeLimit($ImgSize, $maximumSize = null)
	{
		if ($maximumSize != null) {
			if ($ImgSize < $maximumSize) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	/**
	 * @param $ImgType                  Image type which is selected for upload
	 * @param array $allowedType        Allowed image type
	 * @return bool                     Return true or false
	 */
	function ImageType($ImgType, array $allowedType = null)
	{
		if ($allowedType != null) {
			$i = 0;
			while ($i < sizeof($allowedType)) {
				if ($ImgType == "image/" . $allowedType[$i]) {
					return true;
					break;
				}
				$i++;
			}
			return false;
		} else {
			if ($ImgType == "image/jpg" || $ImgType = "image/png" || $ImgType == "image/gif") {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * @param null $path
	 * @return bool
	 */
	function CheckPath($path = null)
	{
		if ($path != null) {
			if (is_dir($path)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	/**
	 * @param null $path
	 * @return bool
	 */
	function CheckPermission($path = null)
	{
		if ($path != null) {
			if (is_writable($path)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}