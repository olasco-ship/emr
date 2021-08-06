<?php

class UserCart
{
    public static function get_cart()
    {
        $cart = $_SESSION['cart'];
        if (isset($cart) && !empty($cart))
            return $cart;
        return array();
    }

    public static function add_to_cart(Product $product, $quantity)
    {
        $items = static::get_cart();
        $exist = false;

        foreach ($items as $item) {
            if ($item->id == $product->id) {
                $item->quantity = $item->quantity + $quantity;
                $item->total = $item->price * $item->quantity;
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $t = new stdClass();
            $t->id = $product->id;
            $t->name = $product->name;
            $t->price = $product->price;
            $t->quantity = $quantity;
            $t->total = $t->price * $t->quantity;
            array_push($items, $t);
        }

        $_SESSION['cart'] = $items;
        return count($items);
    }

    public static function delete_from_cart($id)
    {
        $items = static::get_cart();
        $index = 0;
        foreach ($items as $item) {
            if ($item->id == $id) {
                array_splice($items, $index, 1);
                break;
            }
            ++$index;
        }
        $_SESSION['cart'] = $items;
        return count($items);
    }

    public function clear_cart()
    {
        $_SESSION['cart'] = array();
    }


    public static function total_price()
    {
        $items = static::get_cart();
        $amount = 0;
        foreach ($items as $item) {
            $amount += $item->total;
        }
        return $amount;
    }

    public static function total_quantity(){
        $items = static::get_cart();
        $quantity = 0;
        foreach ($items as $item){
            $quantity += $item->quantity . "<br/>";
        }
        return $quantity;
    }

    public static function decrease_cart_quantity(Product $product, $quantity)
    {
        $items = static::get_cart();

        foreach ($items as $item) {
            if (($item->id == $product->id) and ($item->quantity != 1)) {
                $item->quantity = $item->quantity - $quantity;
                $item->total = $item->price * $item->quantity;
                break;
            } else if (($item->id == $product->id) and ($item->quantity == 1)) {
               return static::delete_from_cart($item->id);
            }
        }
        $_SESSION['cart'] = $items;
        return count($items);
    }

    public static function get_cart_products()
    {
        $items = static::get_cart();
        $prod = '';
        foreach ($items as $item) {
            $prod .= $item->name . "<br/>";
        }
        return $prod;

    }

    public static function get_cart_quantity()
    {
        $items = static::get_cart();
        $qty = '';
        foreach ($items as $item) {
            $qty .= $item->quantity . "<br/>";
        }
        return $qty;
    }

    public static function get_quantity()
    {
        $items = static::get_cart();
        $ts = Product::find_all();
        $r = '';
        foreach ($ts as $t) {
            $r .= $t->quantity . "<br/>";
        }
        return $r;

    }


    public static function render_cart()
    {
        $items = static::get_cart();

        if (count($items) == 0)
            return '<h4>Your cart is empty!</h4>';

        $text = '<div class="user-cart" ><table class="table table-condensed"><tbody>';
        foreach ($items as $item)
            $text .= static::get_single_cart_item($item);
        $total = static::total_price();
        $text .= "<tr>
                <td colspan='3' class='text-left'><strong>Subtotal : </strong></td>
                <td colspan='3' class='text-left'><strong>₦$total</strong></td>
                </tr>";
        $text .= '</tbody></table>
                <div>
                <form action="checkout.php">  
                 <button type="submit"  class="btn btn-danger">CHECK OUT</button>
                 </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_cart_item($product)
    {
        return "<tr>
                    <td><img src='$product->image' width='50'></td>
                    <td>$product->name</td>
                    <td>₦$product->price</td>
                    <td>x $product->quantity</td>                
                    <td>₦$product->total</td>               
                    <td><span data-id='$product->id' class='increase_cart'><i class='glyphicon glyphicon-plus' </span></td>
                    <td><span data-id='$product->id' class='decrease_cart'><i class='glyphicon glyphicon-minus' </span></td>
                                 
                 </tr>";
              //    <td><span data-id='$product->id' class='delete_cart'><i class='glyphicon glyphicon-trash' </span></td> 
    }

    public static function checkout_page()
    {
        $items = static::get_cart();

        if (count($items) == 0)
            return '<h4>Your cart is empty!</h4>';

        $text = '<div class="user-cart" ><table class="table table-bordered table-condensed table-hover">
                                <thead>
                        <tr>
                            <th></th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub-Total</th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                        </thead>
        
                <tbody>';
        foreach ($items as $item)
            $text .= static::get_single_checkout_page($item);
        $total = static::total_price();
        $text .= "<tr>
                <td colspan='5' class='text-left'><strong>Subtotal : </strong></td>
                <td colspan='3' class='text-left'><strong>₦$total</strong></td>
                </tr>";



        $text .= '</tbody></table>
                <div>
                <form action="finalcheckout.php">  
                 <button type="submit"  class="btn btn-danger">PROCEED TO CHECKOUT</button>
                 </form>
                </div>
                </div>';

        return $text;
    }

    protected static function get_single_checkout_page($product)
    {
        return "<tr>
                <td><img src='$product->image' width='100'></td>
                <td>$product->name</td>
                <td>x $product->quantity</td> 
                <td>₦$product->price</td>                               
                <td>₦$product->total</td>               
                <td><span data-id='$product->id' class='inc_cart'><i class='glyphicon glyphicon-plus'></i> </span></td>
                <td><span data-id='$product->id' class='dec_cart'><i class='glyphicon glyphicon-minus'></i> </span></td>
                             
             </tr>";

      //     <td><span data-id='$product->id' class='del_cart'><i class='glyphicon glyphicon-trash'></i> </span></td> 
    }
}


