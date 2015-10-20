<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use Vest\User;
use Vest\Tables\Product;
use Vest\Tables\Customer;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
            'seller_id', 
            'product_id',
            'customer_id',
    ];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function seller()
    {
    	return $this->belongsTo('Vest\User'); // un solo vendedor
    }

    public function product()
    {
    	return $this->belongsTo('Vest\Tables\Product'); // un solo producto
    }

    public function customer()
    {
    	return $this->belongsTo('Vest\Tables\Customer'); // un solo cliente
    }

    ///** Filtro para ventas **///
    public static function filterSales($seller, $product, $customer)
    {
        return Sale::sellerid($seller)->productid($product)->customerid($customer)
                ->simplePaginate(5);
    }

    ///** Filtro para ventas de un vendedor **///
    public static function filterSellerSales($current_seller, $seller, $product, $customer)
    {
        return Sale::where('seller_id', $current_seller)
                ->sellerid($seller)
                ->productid($product)
                ->customerid($customer)
                ->simplePaginate(5);
    }

    ///** Filtro para ventas de una empresa **///
    public static function filterCompanySales($idCompanyProducts, $seller, $product, $customer)
    {
        return Sale::whereIn('product_id', $idCompanyProducts)
                ->sellerid($seller)
                ->productid($product)
                ->customerid($customer)
                ->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeSellerid($query, $seller_id)
    {
        if(trim($seller_id) != ''){
            $exists_seller = User::where('id', $seller_id)->exists();
            if($exists_seller){
                $query->where('seller_id', $seller_id);
            }
        }
    }
    public function scopeProductid($query, $product_id)
    {
        if(trim($product_id) != ''){
            $exists_product = Product::where('id', $product_id)->exists();
            if($exists_product){
                $query->where('product_id', $product_id);
            }
        }
    }
    public function scopeCustomerid($query, $customer_id)
    {
        if(trim($customer_id) != ''){
            $exists_customer = Customer::where('id', $customer_id)->exists();
            if($exists_customer){
                $query->where('customer_id', $customer_id);
            }
        }
    }

    ///** Para verificar que seller_id, product_id y customer_id no se repitan **///
    public function idsExists($data)
    {
        return Sale::where('seller_id', $data->get('seller_id'))
            ->where('product_id', $data->get('product_id'))
            ->where('customer_id', $data->get('customer_id'))->exists();
    }
}
