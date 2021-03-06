<?php

namespace App\Http\Livewire\Admin;

use App\Models\{AttributeValue, Category, Product, ProductAttribute, Subcategory};
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $images;
    public $sub_category_id;

    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values = [];

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:products',
        'short_description' => 'required',
        'description' => 'required',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'SKU' => 'required',
        'stock_status' => 'required',
        'featured' => 'required',
        'quantity' => 'required|numeric',
        'image' => 'required|mimes:jpeg,png',
        'category_id' => 'required',
        'images' => 'nullable',
        'images.*' => 'mimes:jpeg,jpg,png,gif',
    ];

    protected $messages = [
        'category_id.required' => 'Veuillez sélectionner une catégorie',
        'SKU.required' => 'Le champ SKU est obligatoire.',
    ];

    protected $validationAttributes = [
        'category_id' => 'categorie',
        'SKU' => 'SKU',
    ];

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }

    public function add()
    {
        if (!in_array($this->attr, $this->attribute_arr)) {
            array_push($this->inputs, $this->attr);
            array_push($this->attribute_arr, $this->attr);
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addProduct()
    {
        $validatedData = $this->validate();

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        #upload image
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;

        #Téléchargement de plusieur image
        if ($this->images) {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $product->images = $imagesname;
        }

        $product->category_id = $this->category_id;
        if ($this->sub_category_id) {
            $product->subcategory_id = $this->sub_category_id;
        }
        $product->save();

        foreach ($this->attribute_values as $key => $attribute_value) {
            $avalues = explode(",", $attribute_value);
            foreach ($avalues as $avalue) {
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }

        // session()->flash('message', 'Le produit a été avec succes');
        $this->alert('success', 'Le produit a été avec succès', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function changeSubcategory()
    {
        $this->sub_category_id = 0;
    }

    public function render()
    {
        $categories = Category::all();
        $sub_categories = Subcategory::where('category_id', $this->category_id)->get();

        $product_attributes = ProductAttribute::all();
        return view('livewire.admin.admin-add-product-component', compact('categories', 'sub_categories', 'product_attributes'))->layout('layouts.base');
    }
}
