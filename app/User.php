<?php

namespace Vest;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 
            'email',
            'password',
            'identifier',
            'mobile',
            'phone',
            'address',
            'type_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value){
        //al crear nuevo usuario, se le palica un hash a la contraseña
        if(!empty($value)){
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    ///** relacion de muchos a uno (relacion inversa) **///
    public function type()
    {
        //retorna un solo objeto type, ya que el usuario solo es de un tipo
        return $this->belongsTo('Vest\Tables\UserTypes');
    }

    public function status()
    {
        //retorna un solo objeto status, ya que el usuario solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }

    ///** relacion de uno a muchos **///
    public function products()
    {
        //retorna un array de objetos, el usuario (empresa) 
        //puede tener varios productos
        return $this->hasMany('Vest\Tables\Product', 'company_id');
        //busca en product el campo company_id (llave foranea en Product)
    }

    ///** relacion de muchos a muchos **///
    public function addedproducts()
    {
        //retorna un array de objetos, el usuario (vendedor)
        //puede tener varios productos añadidos
        return $this->belongsToMany('Vest\Tables\Product')
                    ->withPivot('status');
        //busca en la tabla pivote el campo user_id
    }

    ///** Filtro para usuarios **///
    public static function filterUsers($namemail, $type)
    {
        return User::whereNotIn('id', [1])
                ->namemail($namemail)
                ->type($type)
                ->simplePaginate(5);
    }

    ///** Filtro para sellers **///
    public static function filterSellers($namemail)
    {
        //el id #2 de user_types es el perfil vendedor
        return User::where('type_id', 2)
                    ->seller($namemail)
                    ->simplePaginate(5);
    }

    ///** Filtro para companies **///
    public static function filterCompanies($namemail)
    {
        //el id #3 de user_types es el perfil empresa
        return User::where('type_id', 3)
                    ->company($namemail)
                    ->simplePaginate(5);
    }

    ///** Filtro para productos del vendedor **///
    public static function filterSellerProducts($id, $nameproduct)
    {
        //se busca el usuario con findOrFail para poder llamar a ->addedproducts()
        $seller = User::findOrFail($id);
        //ya que no es un metodo estatico y no se puede usar ::addedproducts()

        return $seller->addedproducts()
                    ->name($nameproduct)
                    ->simplePaginate(5);
        //se usa el scopeName que esta dentro de Product ya que se
        //estan llamando a los productos del vendedor con ->addedproducts()
    }

    ///** Filtro para productos de la empresa **///
    public static function filterCompanyProducts($id, $nameproduct)
    {
        $company = User::findOrFail($id);

        return $company->products()
                    ->name($nameproduct)
                    ->simplePaginate(5);
        //se usa el scopeName que esta dentro del modelo Product
    }

    ///** Verifica si el producto está asignado al vendedor **///
    public function productExists($id)
    {
        //productos del vendedor actual (usuario)
        $products = $this->addedproducts;

        $array = [];
        //se colocan solo los id de los productos dentro de un array
        foreach ($products as $product) {
            $array [] = $product->id;
        }

        //si $array no esta vacio se retorna lo que devuelva in_array()
        return (!empty($array)) ? in_array($id, $array): false;
        //si $array esta vacio se retorna un false
    }

    ///** Scope **///
    public function scopeNamemail($query, $namemail)
    {
        if(trim($namemail) != ""){
            $query->where("name", "LIKE", "%$namemail%")
                    ->orWhere("email", "LIKE", "%$namemail%")
                    ->whereNotIn('id', [1]);
        }    
    }

    public function scopeType($query, $type)
    {
        $types = Tables\UserTypes::select('id')->get();
        
        $array = [];

        //types es un array de objetos
        foreach ($types as $value){
            $array[$value->id] = $value->id;
        }

        if($type != "" && isset($array[$type])){
            
            $query->where("type_id", $type);
        }
    }

    public function scopeSeller($query, $namemail)
    {
        if(trim($namemail) != ""){
            $query->where("name", "LIKE", "%$namemail%")
                    ->orWhere("email", "LIKE", "%$namemail%")
                    ->where('type_id', 2);
        }    
    }

    public function scopeCompany($query, $namemail)
    {
        if(trim($namemail) != ""){
            $query->where("name", "LIKE", "%$namemail%")
                    ->orWhere("email", "LIKE", "%$namemail%")
                    ->where('type_id', 3);
        }    
    }

    public function scopeNameSeller($query, $nameseller)
    {   // se usa para filtrar vendedores de un producto
        if(trim($nameseller) != ""){
            $query->where("name", "LIKE", "%$nameseller%");
        }    
    }//este scope se usa en el modelo Product
}