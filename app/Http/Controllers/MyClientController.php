<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyClientRequest;
use App\Models\MyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class MyClientController extends Controller
{
    //
    public function index()
    {
        $response = MyClient::paginate(10);

        return response()->json($response);
    }

    public function store(MyClientRequest $request)
    {
        $slug = Str::slug($request->name);
        $array = [
            ...$request->validated(),
            'slug' => $slug,
        ];

        $myClient = MyClient::create($array);

        $redis = Redis::connection();
        $redis->set($slug, json_encode($myClient->toArray()));

        $redis    = Redis::connection();
        $response = $redis->get($slug);

        $response = json_decode($response);

        return response()->json([
            'data' => $myClient,
            'slug' => $response,
        ]);
    }
}
