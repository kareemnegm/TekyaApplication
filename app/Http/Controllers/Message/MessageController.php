<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Interfaces\MessageInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    private MessageInterface $MessageRepository;
    public function __construct(MessageInterface $MessageRepository)
    {
        $this->MessageRepository = $MessageRepository;
    }

    public function sendMessage(Request $request)
    {
        $data = $request->input();
           $data['user_id'] = Auth::user()->id;
        $this->MessageRepository->sendMessage($data);
        return $this->successResponse('success', 200);
    }

    public function ProviderRetrieveMessages(Request $request)
    {
        $data=$request;
        $data['shop_id']=Auth::user()->providerShopDetails->id;
      return  $this->MessageRepository->Messages($data);

        }  
}
