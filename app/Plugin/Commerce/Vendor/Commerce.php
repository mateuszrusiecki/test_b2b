<?php

class Commerce {

    public static $taxTypes = array(
        '0.23' => '23 %',
        '0.08' => '8 %',
        '0.00' => '0 %',
        '0.05' => '5 %',
        'ZW.' => 'Zw.',
    );
    private static $instance;

    private function __construct() {
        
    }

    public static function singleton() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    /**
     * @desc Metoda w zaleznosci od STAŁEJ PRICE_TYPE (0 - PRICE_NET - cena liczona od netto, 1 - PRICE_GROSS - cena liczona od brutto)
     * przelicza pozostałe odpowiedniki cen
     * @param type $price
     * @param type $tax_rate
     * @return type array()
     */
    public static function calculateByPriceType($price, $tax_rate, $quantity=1, $discount=0) {
        $price_discount = self::recalculatePriceWhereDiscount($price * $quantity, $discount);
        switch (PRICE_TYPE) {
            case PRICE_NET:
                $tmp = self::calculateFromNettoToBrutto($price, $tax_rate, $quantity, $discount);
                $tmp_discount = self::calculateFromNettoToBrutto($price_discount, $tax_rate);
                return array(
                    'price_net' => $price,
                    'tax_value' => $tmp['tax_value'],
                    'price_gross' => $tmp['price_gross'],
                    'final_price_net' => $price_discount,
                    'final_tax_value' => $tmp_discount['tax_value'],
                    'final_price_gross' => $tmp_discount['price_gross'],
                );
            case PRICE_GROSS:
                $tmp = self::calculateFromBruttoToNetto($price, $tax_rate, $quantity, $discount);
                $tmp_discount = self::calculateFromBruttoToNetto($price_discount, $tax_rate);
                return array(
                    'price_net' => $tmp['price_net'],
                    'tax_value' => $tmp['tax_value'],
                    'price_gross' => $price,
                    'final_price_net' => $tmp_discount['price_net'],
                    'final_tax_value' => $tmp_discount['tax_value'],
                    'final_price_gross' => $price_discount,
                );
        }
    }

    /**
     * Metoda Przelicza pojedyńczą pozycję z netto na brutto
     * @param type $price
     * @param type $tax_rate
     * @return type array()
     */
    public static function calculateFromNettoToBrutto($price, $tax_rate, $quantity=1, $discount=0) {
        $tax = round($quantity * $price * $tax_rate, 2);
        $priceGross = round($price * $quantity + $tax, 2);

        $finalPriceNet = self::recalculatePriceWhereDiscount($quantity * $price, $discount);
        $finalPriceGross = self::recalculatePriceWhereDiscount($quantity * $priceGross, $discount);

        return array(
            'tax_value' => $tax,
            'price_gross' => $priceGross,
            'price_net' => $price * $quantity,
            'final_price_net' => $finalPriceNet, //,                
            'final_price_gross' => $finalPriceGross,
            'final_tax_value' => round($quantity * $finalPriceNet * $tax_rate, 2)//,//, 
        );
    }

    /**
     * @desc Metoda przelicza pojedyńczą pozycję z ceny Brutto na cenę Netto
     * @param type $price
     * @param type $tax_rate
     * @return type array()
     */
    public static function calculateFromBruttoToNetto($price, $tax_rate, $quantity=1, $discount=0) {

        $tax = round(($price * ((($tax_rate * 100)) / (100 + ($tax_rate * 100)))), 2);
        $priceNet = round($quantity * ($price - $tax), 2);

        $finalPriceNet = self::recalculatePriceWhereDiscount($quantity * $priceNet, $discount);
        $finalPriceGross = self::recalculatePriceWhereDiscount($quantity * $price, $discount);

        return array(
            'tax_value' => $quantity * $tax,
            'price_net' => $priceNet,
            'price_gross' => $price * $quantity,
            'final_price_net' => $finalPriceNet,
            'final_price_gross' => $finalPriceGross,
            'final_tax_value' => round(($finalPriceGross * ((($tax_rate * 100)) / (100 + ($tax_rate * 100)))), 2)
        );
    }

    /**
     * Helper do metody calculateTotalTax, reorganizujacy tablice koszyka na: [podatek] => array( 'produkt' )
     * @param type $array
     * @return type array()
     */
    public static function reorganizeOrderItems($array) {
        $tmp = array();
        foreach ($array as $value) {
            $tmp[$value['tax_rate']][] = $value;
        }
        return $tmp;
    }

    /**
     * Metoda na podstawie danych z koszyka tworzy tablice z wartosciami podatkow, jezeli $shipment jest ustawiony dodaje z niego podatek do podsumowania
     * @param type $items
     * @param type $shipment
     * @return type array()
     */
    public static function calculateTotalTax($items, $shipment=null) {
        
//        debug($shipment);
        if ($shipment && !empty($shipment['shipment_price'])) {
            $temp = self::calculateByPriceType($shipment['shipment_price'], $shipment['shipment_tax_rate'], 1, $shipment['shipment_discount']);
            $items[] = array('price' => $temp['price_net'], 'tax_rate' => $shipment['shipment_tax_rate'], 'quantity' => 1, 'discount' => $shipment['shipment_discount']);
        }
        
        $orderItems = self::reorganizeOrderItems($items);
        $ret = array();

        foreach ($orderItems as $tax => $value) {
            $total_price = 0;
            $final_total_price = 0;
            $price_index = 'price';
                        
//            debug($value);
            
            foreach ($value as $orderValue) {
                if (!isSet($orderValue[$price_index])) {
                    switch (PRICE_TYPE) {
                        case PRICE_NET:
                            $price_index = 'price_net';
                            break;
                        case PRICE_GROSS:
                            $price_index = 'price_gross';
                            break;
                    }
                }
                $total_price += ($orderValue[$price_index] * $orderValue['quantity']);
                $final_total_price += self::recalculatePriceWhereDiscount($orderValue[$price_index] * $orderValue['quantity'], $orderValue['discount']);
            }
            $afterCalculate = self::calculateByPriceType($total_price, $tax);
//            debug($afterCalculate);
            $afterCalculateTotal = self::calculateByPriceType($final_total_price, $tax);
//            debug($afterCalculateTotal);
//$total_price     
            $ret[] = array(
                'price_gross' => $afterCalculate['price_gross'],
                'price_net' => $afterCalculate['price_net'],
                'tax_value' => $afterCalculate['tax_value'],
                'final_price_gross' => $afterCalculateTotal['price_gross'],
                'final_price_net' => $afterCalculateTotal['price_net'],
                'final_tax_value' => $afterCalculateTotal['tax_value'],
                'tax' => $tax,
                'taxType' => isset(self::$taxTypes[$tax]) ? self::$taxTypes[$tax] : ''
            );
        }
        return $ret;
        
    }

    /**
     * Jezeli parametr flag jest ustawiony zwraca sume podatku vat dla zamowienia lacznie z podatkiem z wysylki, w przeciwnym wypadku tylko z koszyka
     * @param type $data
     * @param type $flag
     * @return type int
     */
    public static function getTotalPricesForOrder($data, $flag=false) {
        //Sprawdzanie data
        if (isset($data[0]['price_gross'])) {
            $arr = $data;
        } elseif ($flag) {
            //echo "shipemtn";
            $arr = self::calculateTotalTax($data['OrderItem'], $data['Order']);
            //debug($arr);
        } else {
            $arr = self::calculateTotalTax($data['OrderItem']);
        }
        
        $price_gross = 0;
        $price_net = 0;
        $tax_value = 0;
        $final_price_gross = 0;
        $final_price_net = 0;
        $final_tax_value = 0;
        if (!empty($arr)) {
            foreach ($arr as $key => $val) {
                $price_gross += $val['price_gross'];
                $price_net += $val['price_net'];
                $tax_value += $val['tax_value'];
                $final_price_gross += $val['final_price_gross'];
                $final_price_net += $val['final_tax_value'];
                $final_tax_value += $val['final_tax_value'];
            }
        }

        return array(
            'price_gross' => $price_gross,
            'price_net' => $price_net,
            'tax_value' => $tax_value,
            'final_price_gross' => $final_price_gross,
            'final_price_net' => $final_price_net,
            'final_tax_value' => $final_tax_value,  
        );
    }

    /**
     * Metoda pozwala podsumowanie ceny całego koszyka, bierze obecnie pod uwagę typ ceny i przelicza jeżeli jest potrzeba na cenę brutto
     * @param type $orderItems
     * @return type array()
     */
//    public static function getOrderItemsTotalPrice($orderItems) {
//        $total = 0;
//        if (is_array($orderItems)) {
//            foreach ($orderItems as $item) {
//                switch (PRICE_TYPE) {
//                    case PRICE_NET:
//                        $tmp = self::calculateFromNettoToBrutto($item['price'], $item['tax_rate'], $item['quantity'], $item['discount']);
//                        $total += $tmp['final_price_gross'];
//                    case PRICE_GROSS:
//                        $total += self::recalculatePriceWhereDiscount(($item['quantity'] * $item['price']), $item['discount']);
//                }
//            }
//        }
//        return $total;
//    }

    public function __clone() {
        trigger_error('Clone is not allowed.');
    }

    public static function recalculatePriceWhereDiscount($price, $discount) {
        $discount = ($discount / 100);
        $discountValue = $discount * $price;
        $price = $price - $discountValue;
        return $price;
    }

    public static function getPriceForEachOrderItem($price, $quantity=1, $discount=0) {
        $eachTotal = 0;
        $eachTotal = $price * $quantity;
        $discount = ($discount / 100);
        $discountValue = $discount * $eachTotal;
        $eachTotal = $eachTotal - $discountValue;
        //debug($price);
        return $eachTotal;
    }

    /**
     * Metoda zwraca sumacyjna cene koszyka produktów
     * @param type $order
     * @parm type $flag
     * @return type total price dla koszyka bez pozostalych kosztow
     */
    public static function getPriceForAllOrderItems($orderItems, $flag=true) {
        $tmp = 0;
        foreach ($orderItems as $key => $order) {
            $discount = $order['discount'];
            if (!$flag)
                $discount = 0;
            $tmp += self::getPriceForEachOrderItem($order['price'], $order['quantity'], $discount);
        }
        return $tmp;
    }

    public static function getAffiliateGroup($customer_id) {
        return 0;
    }

    public static function getWeightByOrder($order) {
        $weight = 0;
        foreach ($order as $key => $value) {
            $weight += $value['weight'] * $value['quantity'];
        }
        return $weight;
    }

    public static function inOrder($order, $orderItemId){
        foreach($order['OrderItems'] as $orderItem){
            if ($orderItem['id'] == $orderItemId) {
                return false;
            }
        }
        return false;
    }
    
    
//    public static function getShipmentPriceForOrder($){
//        return 1;
//    }
}

?>