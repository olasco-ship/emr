<?php


class StoreIn extends DatabaseObject
{

    protected static $table_name = "storeIn";
    protected static $db_fields = array('id', 'sync', 'code', 'items', 'item_count', 'supplier', 'pharmacy_station', 'receiver',
        'fileName', 'date');


    public $id;
    public $sync;
    public $code;
    public $items;
    public $item_count;
    public $supplier;
    public $pharmacy_station;
    public $receiver;
    public $fileName;
    public $date;

    public    $title;
    private   $temp_path;
    protected $upload_dir = "\invoiceImages";
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
            $this->temp_path = $file['tmp_name'];
            $rand_number = rand(1000, 9999);
            $this->title = "Invoice" . $rand_number;
            //  $this->title = "Invoice" . "003";
            $this->fileName = $this->title . '-' . date("Ymd") . $extension;
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


    public static function find_all_supply_date($start_date, $end_date){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date DESC ");
    }

    public static function find_all_desc(){
        return static::find_by_sql("SELECT * FROM " .static::$table_name . " ORDER BY date DESC " );
    }



    public static function create_table()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . StoreIn::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'sync VARCHAR(20) NOT NULL, ' .
            'code VARCHAR(50) NOT NULL, ' .
            'items TEXT NOT NULL, ' .
            'item_count INT(11) NOT NULL, ' .
            'supplier VARCHAR(80) NOT NULL, ' .
            'pharmacy_station VARCHAR(80) NOT NULL, ' .
            'receiver  VARCHAR(80) NOT NULL, ' .
            'fileName VARCHAR(80) NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        StoreIn::run_script($sql);

    }

}

StoreIn::create_table();