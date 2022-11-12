<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\Proivder\CustomerOrderDetailsResource;
use App\Http\Resources\Proivder\CustomerOrderListResource;
use App\Interfaces\CustomerInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    /**
     * Undocumented function
     *
     * @param CollectionInterface $collectionInterface
     */
    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customersList(Request $request)
    {
        $customerOrdersList = $this->customerInterface->customerOrdersList($request);
        dd($customerOrdersList);
        // return $this->paginateCollection(CustomerOrderListResource::collection($projects), $request->limit, 'customer_orders');

    }




     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerOrder()
    {
        $projects = $this->customerInterface->customerOrderDetails($request);
        // return $this->dataResponse(['collection' => new CustomerOrderDetailsResource($projects)], 'OK', 200);

    }

}
