<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 1/25/2019
 * Time: 12:40 PM
 */

class PatientUpload extends DatabaseObject
{

    protected static $table_name = "patientUpload";
    protected static $db_fields= array('id','patient_id','ClinicDate', 'fileName', 'date');
    public $id;
    public $patient_id;
    public $ClinicDate;
    public $fileName;
    public $date;

    public    $title;
    private   $temp_path;
    protected $upload_dir = "\Images";
  //  protected $upload_dir = "\invoiceImages";
    public    $errors     = array();


    protected $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
    );

    public function attach_file($file)
    {
      //  print_r($file);   echo "<br/>";
        $allowedExts = array("jpeg", "jpg", "png");        
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
    //    echo $file["type"];  exit;

        $info = getimagesize($file['tmp_name']);
        $extension = image_type_to_extension($info[2]);
        if (!$file || empty($file) || !is_array($file)) {
            $this->errors[] = "No file was uploaded.";
            return FALSE;
        } else if ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return FALSE;
        } else if (in_array($ext, $allowedExts) == FALSE){
            $this->errors[] = "wrong file extension (jpg, jpeg, png format is allowed) ";
            return FALSE;
        } else {          
            $patient = Patient::find_by_id($this->patient_id);
            $this->temp_path = $file['tmp_name'];
            $this->title     = $patient->folder_number;
            $this->fileName  = $this->title ."-". date("Ymd") ."-". "001" . $extension;
            return TRUE;
        }

    }

    public function save()
    {
        if (isset($this->id)) {
            $this->update();
        } else {
            if (!empty($this->errors)) {
                return FALSE;
            }

            if (empty($this->fileName) || empty($this->temp_path)) {
                $this->errors[] = "The file location was not available.";
                return FALSE;
            }

            $target_path = SITE_ROOT . $this->upload_dir . DS . $this->fileName;

         //   echo $target_path;  exit;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->fileName} already exists.";
                return FALSE;
            } 
             if (move_uploaded_file($this->temp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->temp_path);
                    return TRUE;
                }
            } else {
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
                return FALSE;
            }

        }
    }

    public function destroy()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . $this->image_path();
            return unlink($target_path) ? TRUE : FALSE;
        } else {
            return FALSE;
        }
    }

    public function image_path()
    {
        return $this->upload_dir . DS . $this->fileName;
    }





    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . PatientUpload::$table_name . '(' .
            'id INT(11) NOT NULL AUTO_INCREMENT, ' .
            'patient_id INT(11) NOT NULL, ' .
            'ClinicDate  DATE NOT NULL, ' .
            'fileName VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id), ' .
            'UNIQUE KEY(FileName))';

        PatientUpload::run_script($sql);
    }


    // Common Database Methods in the Parent class(DatabaseObject)

}

PatientUpload::create_table();
