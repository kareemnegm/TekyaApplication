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
        // $data['date'] = Carbon::now()->format('h:m A d M Y'); //->format('h:m A d M Y');
        // $data['day'] = Carbon::now(); //->format('l M');
        $data['user_id'] = Auth::user()->id;
        $this->MessageRepository->sendMessage($data);
        return $this->successResponse('success', 201);
    }

    public function ProviderRetrieveMessages()
    {
        $shop_id = Auth::user()->providerShopDetails->id;

      return  $this->MessageRepository->Messages($shop_id);

        }
}
