<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
class Index extends Controller
{
    //快递查询
    public function express()
    {
        dump('213');die;
        $no = input('no','');
        $list = '';
        if(!empty($no)){
            $host = "https://cexpress.market.alicloudapi.com";
            $path = "/cexpress";
            $method = "GET";
            $appcode = "c8e9f371ff184d579872a4b89ef077a9";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            $querys = "no=".$no;
            $bodys = "";
            $url = $host . $path . "?" . $querys;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$".$host, "https://"))
            {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            $list = json_decode(curl_exec($curl),true);
            //dump($list);die;
            if($list["code"] != "OK"){
                $list = '';
            }
        }
        $this->assign('list',$list);
        //dump($list);die;
        return $this->fetch();
    }
    public function cet(){
        $name = input('name','');
        $tl = rand(30,248);
        $yd = rand(30,248);
        $xz = rand(30,213);
        $xx = "湖北第二师范学院";
        $zkzh = rand(100000,200000);
        $zf = $tl+$yd+$xz;
        $this->assign('xx',$xx);
        $this->assign('yd',$yd);
        $this->assign('xz',$xz);
        $this->assign('zkzh',"3399492".$zkzh);
        $this->assign('tl',$tl);
        $this->assign('zf',$zf);
        if(empty($name)){
            $status = 0;
        }else{
            $status = 1;
            if(mb_strlen($name)<=1 || mb_strlen($name)>4){
                $status = 0;
            }
        }

        $this->assign('name',$name);
        $this->assign('status',$status);

        return $this->fetch();
    }

}
