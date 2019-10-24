<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webstore;

class WebstoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$webstores = Webstore::all();
		
		return view('webstores.index',compact('webstores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('webstores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            
            'ItemDesc'=>'required',
            'Email'=>'required'
        ]);

        $webstore = new Webstore([
            'MerchantID' => $request->get('MerchantID'),
            'TradeInfo' => $request->get('TradeInfo'),
            'TradeSha' => $request->get('TradeSha'),
            'ResponsdType' => $request->get('ResponsdType'),
            'TimeStamp' => $request->get('TimeStamp'),
            'Version' => $request->get('Version'),
			'MerchantOrderNo' => $request->get('MerchantOrderNo'),
			'Amt' => $request->get('Amt'),
			'ItemDesc' => $request->get('ItemDesc'),
			'Email' => $request->get('Email'),
			'LoginType' => $request->get('LoginType')
        ]);
        $webstore->save();
        return redirect('/webstores')->with('success', 'webstores saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$webstore = Webstore::find($id);
		
		
		$mid="MS12345678";
		
		$money=$webstore->Amt;
		//$date_now=gmdate("Y-m-d H-i-s" ,strtotime("+8 hours"));
		//$date_now=strtotime($date_now);
		$date_now=date("Y-m-d");
		$mtorderNo=mt_rand(101,999).time();
		$itemdesc="商品名稱";
		$email="admin@gmail.com";
		
		$Notifyurl='';
		$Returnurl='';
		$Customerurl='';
		
		$trade_info_arr = array(
		'MerchantID' => 'MS12345678',
		'RespondType' => 'JSON',
		'TimeStamp' => $date_now,
		'Version' => 1.5,
		'MerchantOrderNo' => $mtorderNo,
		'Amt' => $money,
		'ItemDesc' => $itemdesc
		);
		$mer_key = '*****************************';
		$mer_iv = '*****************'; 
		//交易資料經 AES 加密後取得 TradeInfo 
		$TradeInfo = $this->create_mpg_aes_encrypt($trade_info_arr, $mer_key, $mer_iv); 
		$sha256=strtoupper(hash("sha256","HashKey=$mer_key&".$TradeInfo."&HashIV=$mer_iv"));
		
		$webstore->MerchantID =  $mid;
        $webstore->TradeInfo = $TradeInfo;
        $webstore->TradeSha = $sha256;
        $webstore->ResponsdType = 'Json';
        $webstore->TimeStamp = $date_now;
        $webstore->Version = '1.5';
        $webstore->MerchantOrderNo = $mtorderNo;
        //$webstore->Amt = $request->get('Amt');
        //$webstore->ItemDesc = $request->get('ItemDesc');
        //$webstore->Email = $request->get('Email');
        $webstore->LoginType = '0';
		
		
		return view('webstores.show',compact('webstore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$webstore = Webstore::find($id);
		return view('webstores.edit',compact('webstore'));
    }
	
	//--this no defind can't use ----
	public function send($id)
	{
		$webstore = Webstore::find($id);
		return view('webstores.send',compact('webstore'));
	}
	function addpadding($string, $blocksize = 32)
	{
		$len = strlen($string);
		$pad = $blocksize - ($len % $blocksize);			
		$string .= str_repeat(chr($pad), $pad);
		return $string;      
	}
	function create_mpg_aes_encrypt ($parameter="", $key="", $iv="")
	{
		$return_str='';
		if (!empty($parameter)) 
		{ 
			//將參數經過 URL ENCODED QUERY STRING 
			$return_str = http_build_query($parameter);
		}
		//return trim(bin2hex(openssl_encrypt(addpadding($return_str), 'aes-256-cbc', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv)));
		return trim(bin2hex(openssl_encrypt($this->addpadding($return_str),
		'aes-256-cbc', $key, 1, $iv)));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$request->validate([
            
            'ItemDesc'=>'required',
            'Email'=>'required'
        ]);
		
		$webstore = Webstore::find($id);
		$webstore->MerchantID =  $request->get('MerchantID');
        $webstore->TradeInfo = $request->get('TradeInfo');
        $webstore->TradeSha = $request->get('TradeSha');
        $webstore->ResponsdType = $request->get('ResponsdType');
        $webstore->TimeStamp = $request->get('TimeStamp');
        $webstore->Version = $request->get('Version');
        $webstore->MerchantOrderNo = $request->get('MerchantOrderNo');
        $webstore->Amt = $request->get('Amt');
        $webstore->ItemDesc = $request->get('ItemDesc');
        $webstore->Email = $request->get('Email');
        $webstore->LoginType = $request->get('LoginType');

        $webstore->save();

        return redirect('/webstores')->with('success', 'Webstore updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$webstore = Webstore::find($id);
		$webstore->delete();
		
		return redirect('/webstores')->with('success','Webstore Deleted!');
    }
	
	
	//this get the request
	private $key = '******************************';
	private $iv = '********************';
	
	public function getreq(Request $request){
		
		$callBackInfo = $request->input('TradeInfo');
		
		//--
		//DB::insert('insert into log (id, LOG, time, datainfo) values (?, ?, ?, ?)', [ 12, 123,1017,$callBackInfo]);
		//--

		$callBackURL = 'url';

		$data['data'] = $this->strippadding(openssl_decrypt(hex2bin($callBackInfo),'AES-256-CBC', $this->key,OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $this->iv));
		$data['data'] = $this->encode_arr(json_decode($data['data'],true));
		$data['code'] = hash('sha256', $this->key.$this->iv.$data['data']);		

		$this->upload($callBackURL, $data);
	
    }
	private function strippadding($string) {
        $slast = ord(substr($string,-1));
        $slastc = chr($slast);
        if (preg_match("/$slastc{".$slast."}/", $string)) {
            $string = substr($string,0,strlen($string) - $slast);
            return $string;
        } else {
            return false;
        }
    }
	
    /**
     * 加密 base64
     *
     * @param orderInfo
     * @return tradeInfo
     */
    private function encode_arr($orderInfo) {		 
		return base64_encode(serialize($orderInfo));
    }	
	private function upload($postUrl, $dataInfo) {
		
		$html = "<form id='payPost' name='payPost' method='post' action=$postUrl >";
		$str="";
        foreach ($dataInfo as $key => $value) {
            $html .= "<input type='hidden' name=$key value=$value>";
			//$str.='name="'.$key.'" value="'.$value.'"';
			//$str.= "name=$key value=$value";
			
			if($key=="data")
			{
				//$str.=unserialize(base64_decode($value));
				$str.=$value;
			}
        }
		
		$strdecode=unserialize(base64_decode($str));
		$data="status=".$strdecode['Status']."Result MerchantOrderNo = ".$strdecode['Result']['MerchantOrderNo']."Result AMT = ".$strdecode['Result']['Amt']."Result TradeNo = ".$strdecode['Result']['TradeNo'];
		$data.="Result PaymentType = ".$strdecode['Result']['PaymentType']."Result paytime = ".$strdecode['Result']['PayTime'];
		$data.="message = ".$strdecode['Message'];
		
        $html .= "</form>";
        $html .= "<script>";
        $html .= "document.payPost.submit();";
        $html .= "</script>";
		
		$time = date('Y-m-d');
		$t=time();
		DB::insert('insert into log (id, LOG, time, datainfo) values (?, ?, ?, ?)', [ 1, 223,$time."->".$t,$str]);
		DB::insert('insert into log (id, LOG, time, datainfo) values (?, ?, ?, ?)', [ 3, 223,$time."->".$t,$data]);

		DB::insert('insert into log (id, LOG, time, datainfo) values (?, ?, ?, ?)', [ 0, 123,$time."->".$t,$html]);
		//----
        exit($html);
    }
}
