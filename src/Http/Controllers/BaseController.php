<?php
/**
 * Created by PhpStorm.
 * AuthUser: woisk
 * Date: 2018/1/6
 * Time: 13:33
 */

namespace Woisk\Auth\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected  function res($code=200,$msg='ok',$data='')
    {
        return response()->json(['code'=>$code,'msg'=>$msg,'data'=>$data],200);
    }



}