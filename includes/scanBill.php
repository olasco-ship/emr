<?php



class ScanBill
{
    public static function get_bill()
    {
        $bill = $_SESSION['scan_bill'];
        if (isset($bill) && !empty($bill))
            return $bill;
        return array();
    }

    public static function add_to_bill(Test $test, $quantity, $patient, $overwrite = false)
    {
        $items = static::get_bill();
        $exist = FALSE;

        foreach ($items as $item) {
            if ($item->id == $test->id) {
                $item->quantity = $overwrite ? $quantity : ($item->quantity + $quantity);
                $item->total = $item->price * $item->quantity;
                $exist = TRUE;
                break;
            }
        }

        if (!$exist) {
            $t = new stdClass();
            $t->id = $test->id;
            $t->name = $test->name;
            $t->price = $test->price;
            $t->patientId = $patient;
            $t->quantity = $quantity;
            $t->total = $t->price * $t->quantity;
            array_push($items, $t);
        }

        $_SESSION['scan_bill'] = $items;
        return count($items);

    }

    public static function get_patient()
    {
        $patient = $_SESSION['my_patient'];
        if (isset($patient) && !empty($patient))
            return $patient;
        return array();
    }

    public static function get_patient_id($id)
    {
        return $id;
    }

    public static function delete_from_bill($id)
    {
        $items = static::get_bill();
        $index = 0;
        foreach ($items as $item) {
            if ($item->id == $id) {
                array_splice($items, $index, 1);
                break;
            }
            ++$index;
        }
        $_SESSION['scan_bill'] = $items;
        return count($items);
    }

    public function clear_bill()
    {
        $_SESSION['scan_bill'] = array();
    }

    public static function clear_all_bill()
    {
        $_SESSION['scan_bill'] = array();
    }

    public static function total_price()
    {
        $items = static::get_bill();
        $amount = 0;
        foreach ($items as $item) {
            $amount += $item->total;
        }
        return $amount;
    }

    public static function total_unit()
    {
        $items = static::get_bill();
        $quantity = 0;
        foreach ($items as $item) {
            $quantity += $item->quantity . "<br/>";
        }
        return $quantity;
    }

    public static function decrease_bill_unit(Test $test, $quantity)
    {
        $items = static::get_bill();
        foreach ($items as $item) {
            if (($item->id == $test->id) and ($item->quantity != 1)) {
                $item->quantity = $item->quantity - $quantity;
                $item->total = $item->price * $item->quantity;
                break;
            } else if (($item->id == $test->id) and ($item->quantity == 1)) {
                return static::delete_from_bill($item->id);
            }
        }
        $_SESSION['scan_bill'] = $items;
        return count($items);
    }

    public static function get_bill_unit()
    {
        $items = static::get_bill();
        $quantity = '';
        foreach ($items as $item) {
            $quantity .= $item->quantity . "<br/>";
        }
        return $quantity;
    }

    public static function render_bill()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No Test Request Selected! </h4>';

        $text = '<div class="user-bill" >
                    <form  method="post" action="" >
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Lab. Investigation(s)</th>
                            <th></th>

                            
                        </tr>
                        </thead>';

        //   <tbody>';
        //  $text = '<div class="user-bill"><table class="table table-condensed"><tbody>';

        foreach ($items as $item)
            $text .= static::get_single_bill_item($item);

        // if ()

        $text .= "<tr>
                    <td colspan='2'>
                    <textarea class='form-control' rows='5' cols='50' placeholder='Notes' name='doc_com'></textarea>
                    </td>                          
                 </tr>";

        $text .= '</tbody></table>
                 <div>
                 
                  <button type="submit" name="save_test" class="btn btn-success">Save Lab Investigations</button>  
                </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_bill_item($test)
    {
        return "<tr>
                    <td>$test->name</td>               
                    <td><span data-id='$test->id' class='decrease_bill'><i class='icon-trash' </span></td>  
                 </tr>";
    }


    public static function render_scan_bill()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No Radiology/Scan Request Selected! </h4>';

        $text = '<div class="user-bill" >
                    <form  method="post" action="" >
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Radiology/Scan Investigation(s)</th>
                            <th></th>

                            
                        </tr>
                        </thead>';

        //   <tbody>';
        //  $text = '<div class="user-bill"><table class="table table-condensed"><tbody>';

        foreach ($items as $item)
            $text .= static::get_single_scan_bill_item($item);

        $text .= "<tr>
                    <td colspan='2'>
                    <textarea rows='5' cols='50' placeholder='comments' name='doc_com'></textarea>
                    </td>                          
                 </tr>";

        $text .= '</tbody></table>
                 <div>
                 
                  <button type="submit" name="save_scan" class="btn btn-success">Save Investigations</button>  
                </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_scan_bill_item($test)
    {
        return "<tr>
                    <td>$test->name</td>               
                    <td><span data-id='$test->id' class='decrease_bill'><i class='icon-trash' </span></td>  
                 </tr>";
    }


    public static function medical_bill()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No Test Request Selected! </h4>';

        $text = '<div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Revenue(s)</th>
                            <th></th>

                            
                        </tr>
                        </thead>';

        //   <tbody>';
        //  $text = '<div class="user-bill"><table class="table table-condensed"><tbody>';
        foreach ($items as $item)
            $text .= static::get_single_medical_bill($item);
        //  $total = static::total_price();

        $text .= '</tbody></table>
                 <div>
                 <form  method="post" action="" >
                  <button type="submit" name="save_test" class="btn btn-success">Continue To Treatment</button>  
                </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_medical_bill($test)
    {
        return "<tr>
                    <td>$test->name</td>               
                    <td><span data-id='$test->id' class='decrease_bill'><i class='icon-trash' </span></td>  
                 </tr>";
    }


    public static function save_page()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4> No Test Request Selected! </h4>';

        $text = '<form method="post" action=""><div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Item(s)</th>
                            <th>Unit</th>

                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
        foreach ($items as $item)
            $text .= static::get_single_save_page($item);
        $total = static::total_price();
        $text .= "<tr>
                </tr>";


        $text .= '</tbody></table>
                <div>
                 <button type="submit"  class="btn btn-danger">SAVE </button>
                </div>
                </div> </form>';

        return $text;
    }

    protected static function get_single_save_page($test)
    {
        return "<tr>
                <td>$test->name</td>
                <td><input data-id='$test->id' type='text' class='inp_numb' value='$test->quantity' style='width:40px;' ></td> 
                <td><span data-id='$test->id' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }


}







