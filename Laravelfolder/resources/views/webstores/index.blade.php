@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Webstores</h1>   
	<div>
    <a style="margin: 19px;" href="{{ route('webstores.create')}}" class="btn btn-primary">New webstore</a>
    </div>	
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>MerchantID</td>
          <td>TradeInfo</td>
          <td>TradeSha</td>
          <td>ResponsdType</td>
          <td>TimeStamp</td>
		  <td>Version</td>
		  <td>MerchantOrderNo</td>
		  <td>Amt</td>
		  <td>ItemDesc</td>
		  <td>Email</td>
		  <td>LoginType</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($webstores as $webstore)
        <tr>
            <td>{{$webstore->id}}</td>
            <td>{{$webstore->MerchantID}}</td>
            <td>{{$webstore->TradeInfo}}</td>
            <td>{{$webstore->TradeSha}}</td>
            <td>{{$webstore->ResponsdType}}</td>
            <td>{{$webstore->TimeStamp}}</td>
			<td>{{$webstore->Version}}</td>
			<td>{{$webstore->MerchantOrderNo}}</td>
			<td>{{$webstore->Amt}}</td>
			<td>{{$webstore->ItemDesc}}</td>
			<td>{{$webstore->Email}}</td>
			<td>{{$webstore->LoginType}}</td>
            <td>
                <a href="{{ route('webstores.edit',$webstore->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('webstores.destroy', $webstore->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
			<td>
				<a href="{{ route('webstores.show',$webstore->id)}}" class="btn btn-primary">Send</a>
			</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
</div>
@endsection