<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webstore extends Model
{
    //
	protected $fillable = [
        'MerchantID',
        'TradeInfo',
        'TradeSha',
        'ResponsdType',
        'TimeStamp',
        'Version',
		'MerchantOrderNo',
		'Amt',
		'ItemDesc',
		'Email',
		'LoginType'
    ];
}
