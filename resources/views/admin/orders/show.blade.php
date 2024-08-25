@extends('admin.layouts.master')
@section('title', $title)

@section('content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4" id="sectionToPrint">

 <style>
  @media print {
  .hide_content {
    display: none !important;
  }
  .table-responsive{
    all:unset;
  }
}
</style>

    <div class="card-header py-3 hide_content">
    <h6 class="m-0 font-weight-bold text-primary float-left">Order History</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Total Products</th>
            <th>Total Amount</th>
            <th>Order Status</th>
            <th class="hide_content">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->total_products ?? 0}}</td>
            <td>₹{{number_format($order->total_amount,2)}}</td>
            <td>
              <form action="{{route($route.'.update',$order->id)}}" method="post" id="update_order_status">
                @csrf
                @method('patch')
                <select name="order_status" id="" class="form-control order_status">
                    <option value="new" @if($order->order_status == 'new') selected @endif>new</option>
                    <option value="process" @if($order->order_status == 'process') selected @endif>process</option>
                    <option value="delivered" @if($order->order_status == 'delivered') selected @endif>delivered</option>
                    <option value="canceled" @if($order->order_status == 'canceled') selected @endif>canceled</option>
                </select>
              </form>
                </td>
                <td class="hide_content">                  
                  <a href="{{route($route.'.print',$order->id)}}"><i class="fa fa-print"></i></a>
                </td>
        </tr>
        <input type="hidden" value="{{$order->id}}" class="order_id">
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">ORDER INFORMATION</h4>               
              <table class="table">
                    <tr class="">
                        <td>Order Number</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td> : 
                        <?php
                            $date=date_create($order->created_at);
                            echo date_format($date,"d-m-Y (h:i:s A)");
                          ?>
                      </td>
                    </tr>
                    <tr>
                        <td>Total Products</td>
                        <td> : {{$order->total_products ?? '---'}}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td> : {{$order->order_status}}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td> : ₹ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td> : @if($order->payment_method=='cod') Cash on Delivery @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td> : {{$order->payment_status ?? ''}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
              <table class="table">
                    <tr class="">
                        <td>Full Name</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone No.</td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td> : 
                            {{$order->first_name}} {{$order->last_name}}, <br>
                            {{$order->house_no}} {{$order->area}},<br>
                            {{$order->landmark}} {{$order->town_city}},<br>
                            {{$order->address}} ,<br>
                            {{$order->title ?? ""}}, {{$order->pin_code}}
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td> : {{$order->title ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Post Code / Pin Code</td>
                        <td> : {{$order->pin_code ?? ''}}</td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      dd($order);
      <form method="post" action="{{route($route.'.order_process',$order->id)}}" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('patch')
      <div class="modal-body">    
              <div class="row">                                                          
                  <div class="col-md-12">
                      <label for="courier_service_name" class="col-form-label">Courier Service Name </label>
                      <input type="text" name="courier_service_name" class="form-control" placeholder="Enter courier service name">
                  </div><br>
                  <div class="col-md-12">
                      <label for="tracking_id" class="col-form-label">Tracking Id</label>
                      <input type="text" name="tracking_id" class="form-control" placeholder="Enter tracking id">
                  </div><br>
                  <div class="col-md-12">
                      <label for="dispatch" class="col-form-label">Dispatch</label>
                      <input type="text" name="dispatch" class="form-control" placeholder="Enter dispatch">
                  </div><br>
                  <div class="col-md-12">
                      <label for="expected_time" class="col-form-label">Expected Time of Delivery</label>
                      <input type="date" name="expected_time" class="form-control" placeholder="Enter expected time">
                  </div>                          
              </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<script>
    $(document).ready(function() { 
        $(".order_status").change(function(){
            var status = $(this).val();
            if (status == 'process') {
              $("#exampleModal").modal('show');
            }else{
              $("#update_order_status").submit();
            }            
        })
        
    })
 </script>
 
<script>
$(document).ready(function() {
    $('#printButton').click(function() {
        var sectionToPrint = $('#sectionToPrint').html();
        var originalBody = $('body').html();

        $('body').html(sectionToPrint);
        window.print();

        $('body').html(originalBody);
    });
});

</script>

@endsection




