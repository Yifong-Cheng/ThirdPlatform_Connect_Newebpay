@extends('base')

@section('main')
<div class="container">
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a webstores</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('webstores.store') }}">
          @csrf
          <div class="form-group">    
              <label for="MerchantID">MerchantID:</label>
              <input type="text" class="form-control" name="MerchantID"/>
          </div>

          <div class="form-group">
              <label for="TradeInfo">TradeInfo:</label>
              <input type="text" class="form-control" name="TradeInfo"/>
          </div>

          <div class="form-group">
              <label for="TradeSha">TradeSha:</label>
              <input type="text" class="form-control" name="TradeSha"/>
          </div>
          <div class="form-group">
              <label for="ResponsdType">ResponsdType(json / string):</label>
              <input type="text" class="form-control" name="ResponsdType"/>
          </div>
          <div class="form-group">
              <label for="TimeStamp">TimeStamp:</label>
              <input type="text" class="form-control" name="TimeStamp"/>
          </div>
          <div class="form-group">
              <label for="Version">Version:</label>
              <input type="text" class="form-control" name="Version"/>
          </div>         
		  <div class="form-group">
              <label for="MerchantOrderNo">MerchantOrderNo:</label>
              <input type="text" class="form-control" name="MerchantOrderNo"/>
          </div>         
		  <div class="form-group">
              <label for="Amt">Amt:</label>
              <input type="text" class="form-control" name="Amt"/>
          </div>         
		  <div class="form-group">
              <label for="ItemDesc">ItemDesc:</label>
              <input type="text" class="form-control" name="ItemDesc"/>
          </div>         
		  <div class="form-group">
              <label for="Email">Email:</label>
              <input type="text" class="form-control" name="Email"/>
          </div>         
		  <div class="form-group">
              <label for="LoginType">LoginType(0/1):</label>
              <input type="text" class="form-control" name="LoginType"/>
          </div>         
          <button type="submit" class="btn btn-primary-outline">Add webstores</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection