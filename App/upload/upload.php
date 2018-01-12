<?php
///////////////////////////////////////////////////////////////////////////////
/**
 * Filename: upload-class.php
 * Purpose: Upload FIles
 * Author: TRAIDNT
 * Developer : Ahmed Elsayed
 * Date: 10/11/2009
 */
///////////////////////////////////////////////////////////////////////////////
Class Upload {
    /**
     * array content allow ext list
     * @protected	array
     */
    protected $_allowext;
    /**
     *  to print logo to images if TRUE
     * @protected	bool
     */
    protected $_logoimages;
    /**
     * create thmubs images if true
     * @protected	bool
     */
    protected $_thumbsimages;
    /**
     * thumbs images width
     * @protected	int
     */
    protected $_th_width;
    /**
     * thumbs images hight
     * @protected	int
     */
    protected $_th_hight;
    /**
     * filename prefix
     * @protected	str
     */
    protected $_nameprefix;
    /**
     * max upload file
     * @protected	int
     */
    protected $_maxsize;
    /**
     * list error's
     * @protected	array
     */
    protected $_error;
    /**
     * list disallow mime type
     * @protected	array
     */
    protected $_disallow_mime = array("text/html",
        "text/plain",
        "magnus-internal/shellcgi",
        "application/x-php",
        "text/php",
        "application/x-httpd-php",
        "application/php",
        "magnus-internal/shellcgi",
        "text/x-perl",
        "application/x-perl",
        "application/x-exe",
        "application/exe",
        "application/x-java",
        "application/java-byte-code",
        "application/x-java-class",
        "application/x-java-vm",
        "application/x-java-bean",
        "application/x-jinit-bean",
        "application/x-jinit-applet",
        "magnus-internal/shellcgi",
        "image/svg",
        "image/svg-xml",
        "image/svg+xml",
        "text/xml-svg",
        "image/vnd.adobe.svg+xml",
        "image/svg-xml",
        "text/xml",
    );
    /**
     * file array info include (name,path,type,ext,etc)
     * @protected	array
     */
    protected $_fileinfo;
    /**
     * site logo path using for print logo
     * @protected	str
     */
    protected $_logopath;
    /**
     * uploading folder
     * @private	str
     */
    private $_uploadfolder;
    /**
     * Constructor
     * @param	array  	list allow ext
     * @param	BOLL	TRUE to print logo OR FALSE to cancel print
     * @param	int		images thumbs width
     * @param	int		images thumbs hight
     * @param	int		max size to upload
     * @param	str		uploading folder #note : Just add slash / at the end of folder name
     * @param	str		site logo path
     * @param	array	list disallow mime type
     * @param	str		filename prefix
     * @return	void
     */
    public function __construct($allowext, $th_width, $th_hight, $maxsize, $uploadfolder, $thumbsimages) {
        $this->_allowext = $allowext;
        $this->_th_width = $th_width;
        $this->_th_hight = $th_hight;
        $this->_maxsize = $maxsize;
        $this->_error = array();
        $this->_fileinfo = array();
        $this->_uploadfolder = $uploadfolder;
        $this->_thumbsimages = $thumbsimages;
    }
    /**
     * Upload File
     * @param	array  	file info array #note : this array content data from $_FILES array
     * 					just have this key [type,name,size,tmp]
     * @param	int		max size
     * @return	full file info array in success OR FALSE in failure
     */
    public function Upload_File($filearray, $maxsize = NULL) {
        //check the right data
        if (is_array($filearray) OR !is_null($filearray[type]) OR
            !is_null($filearray[name]) OR !is_null($filearray[tmp]) OR
            !is_null($filearray[size])) {


            //get file ext
            $filearray[ext] = $this->GetExt($filearray[name]);
            //generate new file key
            $filearray[uniqname] = $this->uniqname();
            //make file new name
            $filearray[newname] = $this->_nameprefix . $filearray[uniqname] . "." . $filearray[ext];
            //the full path to move file
            $filearray[place] =  $this->_uploadfolder . "/";
            $filearray[nplace] = $this->_uploadfolder . "/" . $filearray[newname];
            $this->directory = $filearray[nplace];
            // get file keywords
            $filearray[keywords] = $this->GetFileKeywords($filearray[name]);
//print_r($filearray); die();
            //check if this file is image
            if ($this->is_img($filearray[ext]) and $this->_thumbsimages == true) {
                // the thmbus path
                $filearray[thplace] = $this->_uploadfolder . "/thumbs/" . $filearray[newname];
            }
            // assign file array to var
            $this->_fileinfo = $filearray;
            // check the file ext is allowed or not
            if (!$this->CheckExt($this->_fileinfo[ext])) {
                //return error if file ext is not allowed
                foreach ($this->_allowext as $v) {
                    $allowexts .= $v . ',';
                }
                $allowexts = substr($allowexts, 0, -1);
                $this->return_error("إمتداد الملف غير مصرح به يرجى أستخدام أحد هذه الامتدادات فقط " . ' (' . $allowexts . ')');
            }
            // check the weather of the upload folder
//           if (!$this->ExtDir($this->_fileinfo[ext])) {
//                // return error if folder does not exist And php can't create it
//                $this->return_error("مجلد الرفع غير موجود يرجى إنشاء مجلد الرفع حتى تتمكن من عملية الرفع");
//            }
            /*
              check the file protection some hakers change file ext to other ext like
              phpfile.jpg
              to upload it this function not allowed to change file ext we check the right mime type
             */
            if (!$this->protection($this->_fileinfo[type], $this->_fileinfo[name], $filearray[tmp])) {
                // return error if the mime type of the file ext neq the file mime type
                $this->return_error("هذا الملف ليس من نوع الملفات الذى يتعين ان يكون عليه ");
            }
            //check if file size large than the max upload size
            if (!$this->CheckSize($this->_fileinfo[size], $maxsize)) {
                //return error if file size large than max upload size
                $this->return_error("حجم الملف كبير , يجب ان يكون حجم الملف اقل من ".$maxsize.'  كيلو بايت  ');
            }
            // if count error eq 0
            if (!$this->hasErrors()) {
                // move uploaded file to upload folder
                $up = $this->move_uploaded($this->_fileinfo[tmp], $this->_fileinfo[place], $this->_fileinfo[newname]);

                // if success move
                if ($up) {
                    // if the file type is image
                    if ($this->_thumbsimages == true) {
                        // create file thumbs
                        $thumbs = $this->createthumb($this->_fileinfo[place] . $this->_fileinfo[newname], $this->_fileinfo[ext], $this->_fileinfo[thplace], $this->_th_width, $this->_th_hight);
                        // if php can't create image thumbs
                        if (!$thumbs) {
                            // Delete the original file and the thumbs file
                            @unlink($this->_fileinfo[place] . $this->_fileinfo[newname]);
                            @unlink($this->_fileinfo[thplace]);
                            // return error
                            $this->return_error("حدثت مشكلة أثناء إنشاء الصورة المصغرة , يرجى مراجعة الدعم الفنى الخاص بالاسكربت لتحديد سبب المشكلة ");
                            return(FALSE);
                        }
                    }
                    // if allow print image logo
                    if ($this->_logoimages == TRUE and is_file($this->_logopath)) {
                        // print logo to image
                        $this->printlogo($this->_fileinfo[place] . $this->_fileinfo[newname], $this->_fileinfo[ext], $this->_logopath);
                    }
                    // return the full file info
                    return($this->_fileinfo);
                } else {
                    // if can't move file
                    $this->return_error("حدثت مشكلة أثناء رفع الملف ");
                    return(FALSE);
                }
            } else {
                // if upload file has error
                return(FALSE);
            }
        } else {
            // if have error in function param
            return(FALSE);
        }
    }
    /**
     * GET file ext
     * @param	str  	file name
     * @return	file ext in success Or False in failure
     */
    public function GetExt($filename) {
        // if file name is not null
        if (!is_null($filename)) {
            // make the file name lower case and crop the ext
            $fileext = strtolower(strrchr(strtolower($filename), '.'));
            // replace the dot (.) with blank
            $fileext = str_replace(".", "", $fileext);
            // return the file ext
            return($fileext);
        } else {
            // return false if file name is null
            return(FALSE);
        }
    }
    /**
     * check if file ext allow in allow ext array or not
     * @param	str  	file name
     * @return	BOLL 	TRUE if allowed Or FALSE
     */
    public function CheckExt($ext) {
        // check if ext is nul Or allow ext array is not array
        if (!is_null($ext) OR !is_array($this->_allowext)) {
            // check if ext in array of allow ext
            if (in_array($ext, $this->_allowext)) {
                // return true it's mean it is allow ext
                return(TRUE);
            } else {
                // return false it's mean it is disallow ext
                return(FALSE);
            }
        } else {
            // return false if ext param is null or allowext it not array
            return(FALSE);
        }
    }
    /**
     * check if file size large than max upload size or not
     * @param	int  	file size
     * @param	int  	max file size
     * @return	BOLL 	TRUE Or FALSE
     */
    public function CheckSize($filesieze, $maxsize) {
        // if file size is not null and numeric
        if (is_numeric($filesieze) OR !is_null($filesieze) OR !is_null($this->_maxsize)) {
            if (is_null($maxsize)) {
                $max = $this->_maxsize;
            } else {
                $max = $maxsize;
            }
            //check if file size large than the max upload size
            if (round($filesieze) < $max) {
                return(TRUE);
            } else {
                return(FALSE);
            }
        } else {
            // if file size is  null and  not numeric
            return(FALSE);
        }
    }
    /**
     * generate new key
     * @param	void
     * @return	str 	key
     */
    public function uniqname() {
        return(substr(md5(uniqid(rand())), 0, 10));
    }
    /**
     * chech file type
     * @param	str		file ext
     * @return	boll 	TRUE mean is img
     */
    public function is_img($ext) {
        // list of  images ext
        $picarray = array("jpg", "gif", "png", "jpeg", "bmp", "jpeg");
        // if param ext is not null
        if (!is_null($ext)) {
            // if param ext in images ext array
            if (in_array($ext, $picarray)) {
                // return true to mean it's images
                return(TRUE);
            } else {
                // return false to mean it's not image
                return(FALSE);
            }
        } else {
            // if param ext is  null
            return(FALSE);
        }
    }
    /**
     * generat keywords from filename
     * @param	str		file name
     * @return	array 	false mean file name is null
     */
    private function GetFileKeywords($filename) {
        if (!is_null($filename)) {
            $str = trim($filename);
            $str = preg_replace("#[&].{2,7}[;]#sim", " ", $str);
            $str = preg_replace("#[()A°^!\"A§\$%&/{(\[)\]=}?A´`,;.:\-_\#'~+*]#", " ", $str);
            $str = preg_replace("#\s+#sim", " ", $str);
            $arraw = explode(" ", $str);
            foreach ($arraw as $v) {
                $v = trim($v);
                if (strlen($v) < 3 || in_array($v, $this->_allowext))
                    continue;
                $arr[] = $v;
            }
            $final = @implode(",", $arr);
            return($final);
        }
        else {
            return(false);
        }
    }
    /**
     * get full path
     * @param	void
     * @return	str 	full path
     */
//    private function CurrentFullPath() {
//        $root     = $_SERVER['DOCUMENT_ROOT'];
//        $self     = $_SERVER['PHP_SELF'];
//        $self_arr = explode('/', $self);
//        $self     = '/'.$self_arr[1];
//        return $root . $self;//mb_substr($self, 0, -mb_strlen(strrchr($self, "/")));
//    }
    /**
     * move uploaded file
     * @param	str		file tmp
     * @param	str		new file place
     * @param	str		new file name
     * @return	boll 	TRUE it's success moved
     */
    private function move_uploaded($tmp, $path, $name) {
        // check if all param is not null
        if (!is_null($tmp) OR !is_null($path) OR !is_null($name)) {
            // check if  is writeable dir or not
            if (is_dir($path) AND is_writeable($path)) {
                // move file to file place
                $movefile = @move_uploaded_file($tmp, $path . $name);
                // if success move
                if ($movefile) {
                    return(TRUE);
                } else {
                    // if php can't move file
                    return(FALSE);
                }
            } else {
                // if uploaded dir is not 	writeable
                return(FALSE);
            }
        } else {
            // if  param is null
            return(FALSE);
        }
    }
    /**
     * check the weather ot ext dir
     * @param	str		file ext
     * @return	boll 	TRUE OR FALSE
     */
    private function ExtDir($ext) {
        // if param ext is not null
        if (!is_null($ext)) {
            echo $this->_uploadfolder;
            // if upload folder is not exist create it
            if (!is_dir($this->_uploadfolder)) {
                $mkdir = @mkdir($this->_uploadfolder, 0777);
                if (!$mkdir) { echo '5';
                    // return false if php can't create upload folder
                    return(FALSE);
                }
            } else {
                // if ext folder is not exist
                if (!is_dir($this->_uploadfolder)) {
                    // create ext folder
                    $mkdir = @mkdir($this->_uploadfolder, 0777);
                    // create the thumbs folder
                    $mkdir2 = @mkdir($this->_uploadfolder . "/thumbs", 0777);
                    // if php create folder
                    if ($mkdir AND $mkdir2) {
                        return(TRUE);
                    }
                    // if php can't create folder
                    else {
                        return(FALSE);
                    }
                } else {
                    // if ext folder is exist
                    return(TRUE);
                }
            }
        } else {
            // if param ext is null
            return(FALSE);
        }
    }
    /**
     * print site logo to images
     * @param	str		file name with full path
     * @param	str		file ext
     * @param	str		logo path
     * @return	boll 	TRUE OR FALSE
     */
    public function printlogo($name, $ext, $logo) {
        if (!is_null($name) AND !is_null($ext) AND !is_null($logo) AND function_exists('gd_info')) {
            if (preg_match("/jpg|jpeg/", $ext)) {
                $src_img = imagecreatefromjpeg($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            if (preg_match("/png/", $ext)) {
                $src_img = imagecreatefrompng($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            if (preg_match("/gif/", $ext)) {
                $src_img = imagecreatefromgif($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            $src_logo = imagecreatefrompng($logo);
            $bwidth = imageSX($src_img);
            $bheight = imageSY($src_img);
            $lwidth = imageSX($src_logo);
            $lheight = imageSY($src_logo);
            if ($bwidth > 160 && $bheight > 130) {
                $src_x = $bwidth - ($lwidth + 5);
                $src_y = $bheight - ($lheight + 5);
                ImageAlphaBlending($src_img, true);
                ImageCopy($src_img, $src_logo, $src_x, $src_y, 0, 0, $lwidth, $lheight);
                if (preg_match("/jpg|jpeg/", $ext)) {
                    imagejpeg($src_img, $name);
                }
                if (preg_match("/png/", $ext)) {
                    imagepng($src_img, $name);
                }
                if (preg_match("/gif/", $ext)) {
                    imagegif($src_img, $name);
                }
            } else {
                return(FALSE);
            }
        } else {
            return(FALSE);
        }
    }
    /**
     * create images thumbs
     * @param	str		file name with full path
     * @param	str		file ext
     * @param	str		thumbs file name
     * @param	int		thumbs width
     * @param	int		thumbs haight
     * @return	boll 	TRUE OR FALSE
     */
    public function createthumb($name, $ext, $filename, $new_w, $new_h) {
        if (!is_null($name) AND !is_null($ext) AND !is_null($filename) AND !is_null($new_w)
            AND !is_null($new_h) AND function_exists('gd_info')) {
            if (preg_match("/jpg|jpeg/", $ext)) {
                $src_img = @imagecreatefromjpeg($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            if (preg_match("/png/", $ext)) {
                $src_img = imagecreatefrompng($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            if (preg_match("/gif/", $ext)) {
                $src_img = imagecreatefromgif($name);
                if (!$src_img) {
                    return(FALSE);
                }
            }
            $old_x = imageSX($src_img);
            $old_y = imageSY($src_img);
            $thumb_w = $new_w;
            $thumb_h = $new_h;
            $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
            if (preg_match("/jpg|jpeg/", $ext)) {
                imagejpeg($dst_img, $filename);
            }
            if (preg_match("/png/", $ext)) {
                imagepng($dst_img, $filename);
            }
            if (preg_match("/gif/", $ext)) {
                imagegif($dst_img, $filename);
            }
            imagedestroy($dst_img);
            imagedestroy($src_img);
            return(TRUE);
        } else {
            return(FALSE);
        }
    }
    /**
     * get the mime type by ext
     * @param	str		file name with full path
     * @return	str 	MIME type
     */
    public function Get_File_MimeType($filename, $tmp = '') {
        if (!is_null($filename)) {
            if (function_exists('finfo_open')& 1!=1) {
                $finfo = finfo_open(FILEINFO_MIME);
                $mimetype = finfo_file($finfo, $filename);
                finfo_close($finfo);
                return $mimetype;
            } else {
                $mime_types = array(
                    'txt' => 'text/plain',
                    'htm' => 'text/html',
                    'html' => 'text/html',
                    'php' => 'text/html',
                    'css' => 'text/css',
                    'js' => 'application/javascript',
                    'json' => 'application/json',
                    'xml' => 'application/xml',
                    'swf' => 'application/x-shockwave-flash',
                    'flv' => 'video/x-flv',
                    // images
                    'png' => 'image/png',
                    'jpe' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'jpg' => 'image/jpeg',
                    'gif' => 'image/gif',
                    'bmp' => 'image/bmp',
                    'ico' => 'image/vnd.microsoft.icon',
                    'tiff' => 'image/tiff',
                    'tif' => 'image/tiff',
                    'svg' => 'image/svg+xml',
                    'svgz' => 'image/svg+xml',
                    // archives
                    'zip' => 'application/zip',
                    'rar' => 'application/x-rar-compressed',
                    'exe' => 'application/x-msdownload',
                    'msi' => 'application/x-msdownload',
                    'cab' => 'application/vnd.ms-cab-compressed',
                    // audio/video
                    'mp3' => 'audio/mpeg',
                    'qt' => 'video/quicktime',
                    'mov' => 'video/quicktime',
                    'wmv' => 'video/x-ms-wmv',
                    'avi' => 'video/x-msvideo',
                    'wav' => 'audio/x-wav',
                    'ram' => 'audio/x-pn-realaudio',
                    '3gp' => 'video/3gpp',
                    'ra' => 'audio/vnd.rn-realaudio',
                    'ram' => 'audio/vnd.rn-realaudio',
                    'rm' => 'application/vnd.rn-realmedia',
                    'rpm' => 'audio/x-pn-realaudio-plugin',
                    // adobe
                    'pdf' => 'application/pdf',
                    'psd' => 'image/vnd.adobe.photoshop',
                    'ai' => 'application/postscript',
                    'eps' => 'application/postscript',
                    'ps' => 'application/postscript',
                    // ms office
                    'doc' => 'application/msword',
                    'rtf' => 'application/rtf',
                    'xls' => 'application/vnd.ms-excel',
                    'ppt' => 'application/vnd.ms-powerpoint',
                    // open office
                    'odt' => 'application/vnd.oasis.opendocument.text',
                    'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
                    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                );
                $ext = $this->GetExt($filename);
                if (array_key_exists($ext, $mime_types)) {
                    return $mime_types[$ext];
                } elseif (function_exists('mime_content_type')) {
                    return(mime_content_type($tmp));
                } else {
                    return 'application/octet-stream';
                }
            }
        } else {
            return(FALSE);
        }
    }
    /**
     * fix Ie MIME
     * @param	str		file mime type
     * @return	str
     */
    private function fixIeMIME($mime) {
        switch ($mime) {
            case"application/x-zip-compressed":
                return("application/zip");
                break;
            case"image/x-png":
                return("image/xpng");
                break;
            case"image/pjpeg":
                return("image/jpeg");
                break;
            case"audio/x-mpeg":
            case"audio/mp3":
            case"audio/x-mp3":
            case"audio/mpeg3":
            case"audio/x-mpeg3":
            case"audio/mpg":
            case"audio/x-mpg":
            case"audio/x-mpegaudio":
                return("audio/mpeg");
                break;
            default:
                return($mime);
                break;
        }
    }
    /**
     * chech file protection
     * @param	str		file mime
     * @param	str		file name
     * @return	boll 	TRUE mean is positive file
     */
    public function protection($file_mimetype, $file_name, $tmp = '') {
        //fie IE mime type
        $file_mimetype = $this->fixIeMIME($file_mimetype);
        if (!is_null($file_mimetype) AND !is_null($file_name)) {
            $realmime = $this->Get_File_MimeType($file_name, $tmp);
            if (($realmime != $file_mimetype) AND ($file_mimetype != 'application/octet-stream')) {
                return(FALSE);
            } else {
                if (is_array($this->_disallow_mime)) {
                    if (in_array($file_mimetype, $this->_disallow_mime)) {
                        return(FALSE);
                    } else {
                        return(TRUE);
                    }
                } else {
                    return(TRUE);
                }
            }
        } else {
            return(FALSE);
        }
    }
    /**
     * set new error
     * @param	str		error
     */
    private function return_error($message) {
        return $this->error[] = $message;
    }
    public function showErrors() {
        if ($this->hasErrors()) {
            reset($this->error);
            return($this->error);
            $this->resetErrors();
        }
    }
    public function hasErrors() {
        if (count($this->error) > 0) {
            return true;
        } else {
            return false;
        }
    }
    private function resetErrors() {
        if ($this->hasErrors()) {
            unset($this->error);
            $this->error = array();
        }
    }
    public function __destruct() {
        $this->_allowext = NULL;
        $this->_logoimages = FALSE;
        $this->_th_width = NULL;
        $this->_th_hight = NULL;
        $this->_nameprefix = NULL;
        $this->_maxsize = NULL;
        $this->_error = NULL;
        $this->_fileinfo = NULL;
        $this->_disallow_mime = NULL;
        $this->_logopath = NULL;
        $this->_uploadfolder = NULL;
    }
}
?>