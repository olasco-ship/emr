<?php

class StockBill
{
    public static function get_bill()
    {
        //  $bill = $_SESSION['my_bill'];
        $bill = $_SESSION['pharm_bill'];
        if (isset($bill) && !empty($bill))

            return $bill;
        return array();
    }

    public static function add_to_bill(StockItems $product, $quantity, $patient,  $overwrite = false)
    {
        $items = static::get_bill();
        $exist = FALSE;

        foreach ($items as $item){
            if ($item->id == $product->id) {
                //  $item->dosage =   $dosage;
                //   $items->dosage  = $_POST['dosage[]'];
                $item->quantity = $overwrite ? $quantity : ($item->quantity + $quantity);
                $item->total = $item->price * $item->quantity;
                $exist = TRUE;
                break;
            }
        }

        if (!$exist) {
            $t            = new stdClass();
            $t->id        = $product->id;
            $t->name      = $product->name;
            $t->price     = $product->price;
            $t->patientId = $patient;
            $t->quantity  = $quantity;
            //  $t->dosage    = $dosage;
            $t->total     = $t->price * $t->quantity;
            array_push($items, $t);
        }

        //  $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);

    }

    public static function add_to_each_drug_bill(EachItem $drug, $quantity, $patient, $overwrite = false)
    {
        $items = static::get_bill();
        $exist = FALSE;

        foreach ($items as $item){
            if ($item->id == $drug->id) {
                $item->quantity = $overwrite ? $quantity : ($item->quantity + $quantity);
                $item->total = $item->price * $item->quantity;
                $exist = TRUE;
                break;
            }
        }

        if (!$exist) {
            $t                     = new stdClass();
            $t->id                 = $drug->id;
            $t->product_id         = $drug->product_id;
            $t->drug_request_id    = $drug->drug_request_id;
            //   $investigation         = Product::find_by_id($drug->product_id);
            //   $t->name               = $investigation->name;
            //   $t->price              = $investigation->price;
            $investigation         = StockBatch::find_product_expiring($drug->product_id);
            $prod                  = StockItems::find_by_id($drug->product_id);
            $t->name               = $prod->name;
            $t->price              = $investigation->selling_price;
            $t->quantity           = $quantity;
            $t->total              = $t->price * $t->quantity;
            array_push($items, $t);
        }

        $_SESSION['pharm_bill'] = $items;
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
        foreach ($items as $item){
            if ($item->id == $id) {
                array_splice($items, $index, 1);
                break;
            }
            ++$index;
        }
        //   $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);
    }

    public function clear_bill()
    {
        // $_SESSION['my_bill'] = array();
        $_SESSION['pharm_bill'] = array();
    }
    public static function clear_all_bill()
    {
        //  $_SESSION['my_bill'] = array();
        $_SESSION['pharm_bill'] = array();
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
        $quantity  = 0;
        foreach ($items as $item){
            $quantity += $item->quantity . "<br/>";
        }
        return $quantity;
    }

    public static function decrease_bill_unit(StockItems $product, $quantity)
    {
        $items = static::get_bill();
        foreach ($items as $item) {
            if (($item->id == $product->id) and ($item->quantity != 1)) {
                $item->quantity = $item->quantity - $quantity;
                $item->total = $item->price * $item->quantity;
                break;
            } else if (($item->id == $product->id) and ($item->quantity == 1)){
                return static::delete_from_bill($item->id);
            }
        }
        //  $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);
    }


    public static function decrease_each_bill_unit(EachItem $drug, $quantity)
    {
        $items = static::get_bill();
        foreach ($items as $item) {
            if (($item->id == $drug->id) and ($item->quantity != 1)) {
                $item->quantity = $item->quantity - $quantity;
                $item->total = $item->price * $item->quantity;
                break;
            } else if (($item->id == $drug->id) and ($item->quantity == 1)){
                return static::delete_from_bill($item->id);
            }
        }
        $_SESSION['pharm_bill'] = $items;
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
            return '<h4>Your bill is empty!</h4>';

        $text = '<div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Selected Item(s)</th>
                            <th></th>

                            
                        </tr>
                        </thead>';

        //   <tbody>';




        //  $text = '<div class="user-bill"><table class="table table-condensed"><tbody>';
        foreach ($items as $item)
            $text .= static::get_single_bill_item($item);
        //  $total = static::total_price();

        $text .= '</tbody></table>
                 <div>
                 <form  method="post" action="" >
                  <button type="submit"  class="btn btn-danger">Submit</button>  
                </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_bill_item($product)
    {
        return "<tr>
                    <td>$product->name</td>               
                    <td><span data-id='$product->id' class='decrease_bill'><i class='glyphicon glyphicon-minus' </span></td>  
                 </tr>";
    }

    public static function save_page()
    {

        $items = static::get_bill();
        if (count($items) == 0)
            return '<h4>Your Stock Selection is empty! </h4>';


        $text = '<form method="post" action=""><div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Drug</th>
                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
        foreach ($items as $item)
            $text .= static::get_single_save_page($item);
        $total = static::total_price();
        $text .= "<tr>
                </tr>";


        //  $text.= "<tr>
        //              <td colspan='4'>
        //              <textarea class='form-control' rows='2' cols='70' placeholder='Notes' name='doc_com'></textarea>
        //              </td>
        //           </tr>";



        $text .= '</tbody></table>
                <div>
              
                 <button type="submit" name="save_drug" class="btn btn-success"> Save Prescription </button>
                </div>
                </div> </form>';

        return $text;
    }

    protected static function get_single_save_page($product)
    {
        return "<tr>
                <td>$product->name</td>
        
                <td><span data-id='$product->id' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }

    public static function storage_page()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No Drug is Selected! </h4>';

        $text = '<form method="post" action=""><div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Drug(s)</th>
                           <!-- <th>Qty</th>-->

                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
        foreach ($items as $item)
            $text .= static::get_single_storage_page($item);
        $total = static::total_price();
        $text .= "<tr>
                </tr>";



        $text .= '</tbody></table>
                <div>
                 <button type="submit"  class="btn btn-success"> Save To Dispense </button>
                </div>
                </div> </form>';

        return $text;
    }

    protected static function get_single_storage_page($product)
    {
        /* <td><input data-id='$product->id' type='text' class='inp_num' value='$product->quantity' style='width:60px;' ></td> */
        return "<tr>
                <td>$product->name</td>          
                <td><span data-id='$product->id' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }

    public static function stocking_page()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No Item is Selected! </h4>';

        $text = '<form method="get" action="stocking_one.php"><div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Item(s)</th>
                         
                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
        foreach ($items as $item)
            $text .= static::get_single_stocking_page($item);
        $total = static::total_price();
        $text .= "<tr>
                </tr>";



        $text .= '</tbody></table>
                <div>
                 <button type="submit"  class="btn btn-success"> Save To Continue </button>
                </div>
                </div> </form>';

        return $text;
    }

    protected static function get_single_stocking_page($product)
    {
        $dosage = "";
        return "<tr>
                <td>$product->name</td>
               
                <td><span data-name='$product->name' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }










    //  public static function add_to_bill(Product $product, $quantity, $patient, $overwrite = false)
    public static function add_to_dispense(StockDispensed $dispense, $unit, $patient, $overwrite = false)
    {
        $items = static::get_bill();
        $exist = FALSE;

        foreach ($items as $item){
            if ($item->id == $dispense->id) {
                $item->unit = $overwrite ? $unit : ($item->unit + $unit);
                $item->total = $item->unit_price * $item->unit;
                $exist = TRUE;
                break;
            }
        }

        if (!$exist) {
            $t            = new stdClass();
            $t->id        = $dispense->id;
            $t->name      = $dispense->drugName;
            $t->price     = $dispense->unit_price;
            $t->patientId = $patient;
            $t->unit      = $unit;
            $t->total     = $t->price * $t->unit;
            array_push($items, $t);
        }


        //   $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);

    }



    public static function delete_from_dispense($id)
    {
        $items = static::get_bill();
        $index = 0;
        foreach ($items as $item){
            if ($item->id == $id) {
                array_splice($items, $index, 1);
                break;
            }
            ++$index;
        }
        //   $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);
    }

    public function clear_dispense()
    {
        //  $_SESSION['my_bill'] = array();
        $_SESSION['pharm_bill'] = array();
    }
    public static function clear_all_dispense()
    {
        //  $_SESSION['my_bill'] = array();
        $_SESSION['pharm_bill'] = array();
    }

    public static function total_price_for_dispense()
    {
        $items = static::get_bill();
        $amount = 0;
        foreach ($items as $item) {
            $amount += $item->total;
        }
        return $amount;
    }

    public static function total_unit_for_dispense()
    {
        $items = static::get_bill();
        $unit  = 0;
        foreach ($items as $item){
            $unit += $item->unit . "<br/>";
        }
        return $unit;
    }

    public static function decrease_dispense_unit(StockDispensed $dispense, $unit)
    {
        $items = static::get_bill();
        foreach ($items as $item) {
            if (($item->id == $dispense->id) and ($item->unit != 1)) {
                $item->unit = $item->unit - $unit;
                $item->total = $item->unit_price * $item->unit;
                break;
            } else if (($item->id == $dispense->id) and ($item->unit == 1)){
                return static::delete_from_dispense($item->id);
            }
        }
        //  $_SESSION['my_bill'] = $items;
        $_SESSION['pharm_bill'] = $items;
        return count($items);
    }

    public static function get_dispense_unit()
    {
        $items = static::get_bill();
        $unit = '';
        foreach ($items as $item) {
            $unit .= $item->unit . "<br/>";
        }
        return $unit;
    }



    public static function render_dispense()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>No item is selected!</h4>';

        $text = '<div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Selected Item(s)</th>
                            <th>Unit</th>
                            <th></th>

                            
                        </tr>
                        </thead>';

        //   <tbody>';




        //  $text = '<div class="user-bill"><table class="table table-condensed"><tbody>';
        foreach ($items as $item)
            $text .= static::get_single_dispense_item($item);
        //  $total = static::total_price();

        $text .= '</tbody></table>
                 <div>
                 <form  method="post" action="" >
                  <button type="submit"  class="btn btn-danger">Proceed</button>  
                </form>
                </div>
                </div>';

        return $text;
    }

    /*    protected static function get_single_dispense_item($dispense)
        {
            return "<tr>

                        <td>$dispense->name</td>
                        <td><span data-id='$dispense->id' class='decrease_bill'><i class='glyphicon glyphicon-minus' </span></td>




                     </tr>";
        }*/


    protected static function get_single_dispense_item($dispense)
    {
        return "<tr>
                <td>$dispense->name</td>
                <td><input data-id='$dispense->id' type='text' class='inp_numb' value='$dispense->unit' style='width:40px;' ></td> 
                <td><span data-id='$dispense->id' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }



    public static function save_dispense_page()
    {
        $items = static::get_bill();

        if (count($items) == 0)
            return '<h4>Your Selection is empty! </h4>';

        /*            return '
                                  <form action="stage_two.php" >
                                    <button type="submit"  class="btn btn-success">Continue ooo </button>
                                </form>
                    ';*/

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
            $text .= static::get_single_dispense_page($item);
        $total = static::total_price();
        $text .= "<tr>
                </tr>";



        $text .= '</tbody></table>
                <div>
                 <button type="submit" name="save_drug" class="btn btn-success"> Continue To Treatment </button>
                </div>
                </div> </form>';

        return $text;
    }




    protected static function get_single_dispense_page($dispense)
    {
        return "<tr>
                <td>$dispense->drugName</td>
                <td><input data-id='$dispense->id' type='text' class='inp_numb' value='$dispense->unit' style='width:90px;' ></td> 
                <td><span data-id='$dispense->id' class='dec_bill'><i class='icon-trash'></i> </span></td>
                             
             </tr>";
    }


    public static function drug_page()
    {
        $items = static::get_bill();
        //  print_r($items);

        if (count($items) == 0)
            return '<h4>No Item(s) Selected!</h4>';

        $text = '<div class="user-cart" ><table class="table table-condensed">

                                <thead>
                        <tr>
                            <th>Available Drug(s)</th>
                             <th>Unit Price</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th></th>
                            <th></th>
                                                                                                    
                        </tr>
                        </thead>


<tbody>';
        foreach ($items as $item)
            $text .= static::get_single_drug_page($item);
        $total = static::total_price();
        $text .= "<tr>
                <td colspan='3' class='text-left'><strong>Subtotal : </strong></td>
                <td colspan='3' class='text-left'><strong>₦$total</strong></td>
                </tr>";
        $text .= '</tbody></table>
                <div>
                <form action="" method="post">  
                 <button type="submit" name="generate_bill"  class="btn btn-success"> Generate Bill For Drugs </button>
                 </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_drug_page($drug)
    {
        //  $prodStation = ProductPharmacyStation::find_by_product_and_station($station_id, $ffkf);

        return "<tr>
                    
                    <td>$drug->name</td>
                    <td>₦$drug->price</td>
                    <td>x $drug->quantity</td>                
                    <td>₦$drug->total</td>               
                    <td><span data-id='$drug->id' class='increase_cart'><i class='icon-plus' </span></td>
                    <td><span data-id='$drug->id' class='decrease_cart'><i class='icon-trash' </span></td>
                                 
                 </tr>";
        //    <td><span data-id='$product->id' class='delete_cart'><i class='glyphicon glyphicon-trash' </span></td>
    }


}
?>








