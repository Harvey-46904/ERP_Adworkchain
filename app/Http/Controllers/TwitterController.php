<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;


class TwitterController extends Controller
{
    public function index(){

        $consumerKey="kauKx0q8k35tsTb0i6mjIaxnZ";
        $consumerSecret="Hot8PSpANpXV1Zt8vQwf6KHsFPt896XMDzWDdALF0cc44pQWVS";
        $accessToken="1514229652461662208-Wojt7f9yXO5aJQtxRcWrMlU4tFmd4M";
        $accessTokenSecret="3UUz3GWm3MdtbzwT4ibyhbaTx5BcZmV2lc45acyoQRIIU";


        $connection = new TwitterOAuth(
            $consumerKey,
            $consumerSecret,
            $accessToken,
            $accessTokenSecret
        );

       // $followers=$connection->get('/2/users/2244994945');
        $user = $connection->get('account/verify_credentials');
        $followersCount = $user->location;

        $datas= $connection->get('users/show');
        
        $tweet = $connection->post("statuses/update", ["status" => "Hola como estan?"]);
        return response()->json($tweet);
        return response(["TwitterFollowers"=>$followersCount]);
    }
}
