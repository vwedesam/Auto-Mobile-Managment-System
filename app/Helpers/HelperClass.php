<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\SalesInvoice;
use App\ProductSalesInvoice;
use App\Product;
use App\ProductName;
use App\DealerInformation;
use App\Miscellaneous;
use App\Miscellaneous_sales;

class HelperClass
{
    /**
     * Check if an Invoice Has A particular Product
     *
     * @param $invoice_id, $product_id
     * @return integer
     */
    static function check_product_qty($invoice_id, $product_id)
    {
        $product_sales = ProductSalesInvoice::where('sales_invoice_id', $invoice_id)->get();

        $qty = 0;

        foreach ($product_sales as $products ) {

        	if( $products->product->product_name_id == $product_id){

        		$qty += $products->qty_ordered;

        	}
        }
        return $qty;
        
    }

    /**
     * Check if an Invoice Has A particular Product
     *
     * @param $invoice_id, $product_id
     * @return integer
     */
    static function check_miscellaneous_qty($invoice_id)
    {
        $misc_sales = Miscellaneous_sales::where('sales_invoice_id', $invoice_id)->get();

        $qty = 0;

        if( count($misc_sales) > 0 ){
        	foreach ($misc_sales as $misc ) {
        		$qty += $misc->qty_ordered;
        	}

        }

        return $qty;
        
    }

    
}


?>