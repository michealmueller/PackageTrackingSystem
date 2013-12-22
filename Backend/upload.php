<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/28/13
 * Time: 2:01 AM
 */

namespace Backend;

class upload
{
    public $uploadName;

    function file_upload()
    {
        $idInfo = $_POST['docType'].'_';
        $tmpname = $_FILES['file']['tmp_name'];
        $this->uploadName = $idInfo.$_FILES['file']['name'];

        $allowedExts = array("jpeg", "jpg", "pdf");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "application/pdf"))
            && in_array($extension, $allowedExts))
        {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Error Code: " . $_FILES["file"]["error"] . "<br>";
            }
            else
            {
                if (file_exists('upload/'. $idInfo.$_FILES["file"]["name"]))
                {
                    echo $idInfo.$_FILES["file"]["name"] . "<b> already exists.</b> ";
                }
                else
                {
                    move_uploaded_file($tmpname, 'upload/'.$this->uploadName);
                }
            }
        }
        else
        {
            echo "Invalid file";
            return FALSE;
        }
        return TRUE;
    }

    function getDocs()
    {

    }

    function create_Structure($compName, $doctype)
    {
        $date = date('M-d-Y');

        if($doctype == 'bol')
        {
            $documenttype = 'BOL';
        }
        elseif($doctype == 'pod')
        {
            $documenttype = 'POD';
        }
        else{
            exit("Document type not selected. Please go back and select a document type.");
        }

        $this->pathname = $compName . '/' . $date . '/' . $documenttype;
        $mode = 0644;

        if(file_exists($this->pathname) != TRUE)
        {
            mkdir($this->pathname, $mode, TRUE);
            return TRUE;
        }
        else{
            exit("Directory/File Exists, Could Not Upload File, Please Check that file has not already been uploaded.<br>Please go back and try again.");
        }
    }
} 