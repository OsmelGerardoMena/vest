<?php

namespace Vest;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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

    ///** Mutators **///
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

    public function category()
    {
        // ésta relacion solo es para empresas
        // retorna un solo objeto, ya que la empresa solo tiene una categoría 
        return $this->belongsTo('Vest\Tables\CompanyCategories', 'company_category_id');
        // En relacion inversa, Eloquent asume que en User existe un campo 
        // llamado category_id, pero eso no es cierto por lo tanto se le pasa el
        // segundo parametro que indica la verdadera llave foranea
    }

    ///** relacion de uno a muchos **///
    public function products()
    {
        //retorna un array de objetos, el usuario (empresa) 
        //puede tener varios productos
        return $this->hasMany('Vest\Tables\Product', 'company_id');
        //busca en Product el campo company_id (llave foranea en Product)
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
    public static function filterCompanies($namemail, $category_id)
    {
        //el id #3 de user_types es el perfil empresa
        return User::where('type_id', 3)
                    ->company($namemail)
                    ->companycategory($category_id)
                    ->simplePaginate(5);
    }

    ///** Filtro para productos del vendedor **///
    public static function filterSellerProducts($id, $nameproduct, $company_id)
    {
        //se busca el usuario con findOrFail para poder llamar a ->addedproducts()
        $seller = User::findOrFail($id);
        //ya que no es un metodo estatico y no se puede usar ::addedproducts()

        return $seller->addedproducts()
                    ->name($nameproduct)
                    ->company($company_id)
                    ->simplePaginate(5);
        // se usa el scopeName y scopeCompany que estan dentro de Product ya que
        // se estan llamando a los productos del vendedor con ->addedproducts()
    }

    ///** Filtro para productos de la empresa **///
    public static function filterCompanyProducts($id, $nameproduct, $company_id)
    {
        $company = User::findOrFail($id);

        return $company->products()
                    ->name($nameproduct)
                    ->company($company_id)
                    ->simplePaginate(5);
        // se usa el scopeName y scopeCompany que estan dentro del modelo Product
        // ya se estan llamando a los productos de la empresa con ->products()
    }

    ///** Verifica si el producto está asignado al vendedor **///
    public function productExists($id)
    {
        // productos del vendedor actual (usuario)
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

    public function scopeCompanyCategory($query, $category_id)
    {
        if (trim($category_id) != '') {
            $exists_category = Tables\CompanyCategories::where('id', $category_id)->exists();

            if ($exists_category) {
                // se alamacenan todos los id de las empresas que pertenecen a la categoría 
                $companies = User::where('company_category_id', $category_id)->lists('id');
                $query->whereIn('id', $companies);
            }
        }
    }

    ///** Verifica si el usuario es admin **///
    public function isAdmin()
    {
        return $this->type_id == 1;
    }

    ///** Verifica si el usuario es vendedor **///
    public function isSeller()
    {
        return $this->type_id == 2;
    }

    ///** Verifica si el usuario es empresa **///
    public function isCompany()
    {
        return $this->type_id == 3;
    }

    ///** Verifica el status del usuario **///
    public function isActive()
    {
        if($this->getStatusId() == 1)
            return true;
        else if($this->getStatusId() == 2)
            return false;
    }

    ///** Devuelve el id del status asignado **///
    public function getStatusId()
    {
        return $this->status->id;
    }

    ///** Devuelve el valor del status asignado al vinculo **///
    public function getLinkStatus()
    {   // true o false
        return $this->pivot->status;
    }
}