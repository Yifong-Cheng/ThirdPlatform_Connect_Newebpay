@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Send to webstore</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="https://ccore.newebpay.com/MPG/mpg_gateway">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="MerchantID">MerchantID:</label>
                <input type="text" class="form-control" name="MerchantID" value={{ $webstore->MerchantID }} />
            </div>

            <div class="form-group">
                <label for="TradeInfo">TradeInfo:</label>
                <input type="text" class="form-control" name="TradeInfo" value={{ $webstore->TradeInfo }} />
            </div>

            <div class="form-group">
                <label for="TradeSha">TradeSha:</label>
                <input type="text" class="form-control" name="TradeSha" value={{ $webstore->TradeSha }} />
            </div>
            <div class="form-group">
                <label for="ResponsdType">ResponsdType:</label>
                <input type="text" class="form-control" name="ResponsdType" value={{ $webstore->ResponsdType }} />
            </div>
            <div class="form-group">
                <label for="TimeStamp">TimeStamp:</label>
                <input type="text" class="form-control" name="TimeStamp" value={{ $webstore->TimeStamp }} />
            </div>
            <div class="form-group">
                <label for="Version">Version:</label>
                <input type="text" class="form-control" name="Version" value={{ $webstore->Version }} />
            </div>
			<div class="form-group">
                <label for="MerchantOrderNo">MerchantOrderNo:</label>
                <input type="text" class="form-control" name="MerchantOrderNo" value={{ $webstore->MerchantOrderNo }} />
            </div>
			<div class="form-group">
                <label for="Amt">Amt:</label>
                <input type="text" class="form-control" name="Amt" value={{ $webstore->Amt }} />
            </div>
			<div class="form-group">
                <label for="ItemDesc">ItemDesc:</label>
                <input type="text" class="form-control" name="ItemDesc" value={{ $webstore->ItemDesc }} />
            </div>
			<div class="form-group">
                <label for="Email">Email:</label>
                <input type="text" class="form-control" name="Email" value={{ $webstore->Email }} />
            </div>
			<div class="form-group">
                <label for="LoginType">LoginType:</label>
                <input type="text" class="form-control" name="LoginType" value={{ $webstore->LoginType }} />
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@endsection