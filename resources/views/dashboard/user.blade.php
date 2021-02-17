<style type="text/css">
  .table td .btn {
      color: #ffffff;
  }

  
</style>

@php
   $subscriptions = App\Models\Insurancesubscriptions::where('entry_by',\Auth::id())->get(); 
   $claims = App\Models\Insuranceclaims::where('entry_by',\Auth::id())->get(); 
   $activeSubscription = 0;
@endphp


<div class="p-5">
<div class="row">
    <div class="col-lg-6 mb-3">
      <h5>Subscription Summary</h5>
      <table class="table table-bordered table-responsive" width='100%'>
        <thead>
          <tr>
            <th width='20%'>Package</th>
            <th width='20%'>Subscription ID</th>
            <th width='30%'>Number Of People</th>
            <th width='10%'>Price</th>
            <th width='10%'>Status</th>
            <th width='10%'>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($subscriptions as $s)
          <tr>
            <td>{{ App\Models\Insurancepackage::find($s->package_id)->title ?? '' }}</td>
            <td>{{$s->id}}</td>
            <td>{{$s->number_of_people}}</td>
            <td>{{'BDT '.$s->price}}</td>
            <td>
              @if(Helper::verifyOrder($s->id))
                {{ App\Models\Status::find($s->status)->name ?? '' }}
                @php $activeSubscription++ @endphp
              @else
                   @if($s->status == 1)
                    Expired
                   @else
                    {{ App\Models\Status::find($s->status)->name ?? '' }}
                   @endif
              @endif
              
             </td>
          <td> <a href="{{ '/insurancesubscriptions/'.$s->id }}" class="btn btn-info">View</a> </td>
          </tr>
        @endforeach

        </tbody>
      </table>
    </div>
    
    
    <div class="col-lg-6 mb-3">
      <div class="row">
        <div class="col-md-6"><h5>Claims Summary</h5></div>
        <div class="col-md-6">
          @if($activeSubscription > 0)
          <a href="/insuranceclaims/create" style="padding: 3px 5px;" class="btn btn-success">Create New Claim</a>
          @endif
        </div>
      </div><br>
      <table class="table table-bordered table-responsive" width='100%'>
        <thead>
          <tr>
            <th width='20%'>Claim ID</th>
            <th width='10%'>Package</th>
            <th width='20%'>Insurance Title</th>
            <th width='10%'>Premium</th>
            <th width='20%'>Payment Method</th>
            <th width='10%'>Status</th>
            <th width='10%'>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($claims as $clm)
          <tr>
            <td>{{ $clm->id }}</td>
            <td>{{ App\Models\Insurancepackage::find($clm->package_id)->title ?? '' }}</td>
            <td>{{ App\Models\Insuranceplans::find($clm->package_id)->title ?? '' }}</td>
            
            <td>BDT&nbsp;{{ $clm->premium }}</td>
            <td>{{ $clm->payment_method }}</td>
            <td>{{ App\Models\Status::find($clm->status)->name ?? '' }}</td>

            <td> <a href="{{ '/insuranceclaims/'.$clm->id }}" class="btn btn-info">View</a> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

  