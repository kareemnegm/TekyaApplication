<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ProductInterface $ProductRepository;
    /**
     * Undocumented function
     *
     * @param ProviderInterface $ProviderRepository
     */
    public function __construct(ProductInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }


    public function productsForYou()
    {
        $products =    $this->ProductRepository->productJustForYou();
    }
}
