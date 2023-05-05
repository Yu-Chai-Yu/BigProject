<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatbotController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Chat;
    }
    // private function callOpenAPI($prompt)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => 'https://api.openai.com/v1/completions',
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'POST',
    //       CURLOPT_POSTFIELDS => '{
    //       "model": "text-davinci-003",
    //       "prompt": "' . $prompt . '",
    //       "max_tokens": 200,
    //       "temperature": 0
    //       }
    //       ',
    //       CURLOPT_HTTPHEADER => array(
    //         'Authorization: ?',
    //         'Content-Type: application/json'
    //       ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $jsonObj = json_decode($response,true);
    //     return $jsonObj["choices"][0]["text"];
        
    // }

    public function saveContent(Request $request)
    {
        // 獲取使用者輸入的訊息
        $message = $request->input('message');
        $this->model->saveContent($message,0);

        // 將訊息送到 OpenAI API 中進行回應
        $response = $this->callOpenAPI($message);
        $this->model->saveContent($response,1);
        $this->model->saveContent("我是機器人～",1);
        // 回傳回應訊息
        return response()->json(['message' => $response]);
        // return redirect()->route('takeOutContent');
    }

    public function takeOutContent(){
        $datas = $this->model->takeOutContent();
        return view('robot',['datas'=>$datas]);
    }
}
