<?php

require_once("../includes/initialize.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];


    $product = StockItems::find_by_name($name);
    $result = new StockServiceResult();

    if (!empty($product)){

        $text = '<form method="get" action="stocking_one.php"><div class="user-bill" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th>Items(s)</th>
                         
                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
//        foreach ($items as $item)
//            $text .= static::get_single_stocking_page($item);
//        $total = static::total_price();
//        $text .= "<tr>
//                </tr>";



        $text .= '</tbody></table>
                <div>
                 <button type="submit"  class="btn btn-success"> Save To Dispense </button>
                </div>
                </div> </form>';

        return $text;
    }else{
        return '<h4>No Drug is Selected! </h4>';
    }

}
