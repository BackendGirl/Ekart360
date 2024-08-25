<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('uploads/setting/'.$settings->favicon_path) }}" type="image/x-icon">

    <style>
        .content {
            width: 100%;
        }
        .logoImg img{
          width: 10rem;
        }

        .midContent h1 {
            font-size: 1.7rem;
            font-weight: bold;
        }

        .midContent h4 {
            font-size: 1.2rem;
        }

        .midContent p {
            font-size: .9rem;
        }

        .sideContent p {
            font-size: 1rem;
        }

        .divider {
            background: #000;
            height: .3rem;
            width: 100%;
        }

        .row-2 p {
            text-transform: uppercase;
            margin-bottom: .5rem;
        }

        .tableArea .table-box {
            width: 100%;
            text-transform: uppercase;
        }

        .tableArea .table-box thead {
            border: 2px solid #000;
        }

        .tableArea .table-box thead th {
            border: 2px solid #000;
            padding: .5rem;
        }

        .tableArea .table-box tbody {
            border: 2px solid #000;
            padding: .5rem;
        }

        .tableArea .table-box tbody td {
            border-left: 2px solid #000;
        }

        .tableArea .table-box .tdata {
            text-align: center;
        }

        .tableArea .table-box tbody td {
            padding: .4rem;
        }

        .tableArea .table-box tfoot {
            border: 2px solid #000;
            padding: .5rem;
        }

        .tableArea .table-box tfoot td {
            border-left: 2px solid #000;
        }

        .lowBody td {
            border-bottom: 2px solid #000;
        }
    </style>
</head>

<?php

function convertToWords($number) {
  $words = array(
      0 => 'ZERO',
      1 => 'ONE',
      2 => 'TWO',
      3 => 'THREE',
      4 => 'FOUR',
      5 => 'FIVE',
      6 => 'SIX',
      7 => 'SEVEN',
      8 => 'EIGHT',
      9 => 'NINE'
  );

  $specialWords = array(
      10 => 'TEN',
      11 => 'ELEVEN',
      12 => 'TWELVE',
      13 => 'THIRTEEN',
      14 => 'FOURTEEN',
      15 => 'FIFTEEN',
      16 => 'SIXTEEN',
      17 => 'SEVENTEEN',
      18 => 'EIGHTEEN',
      19 => 'NINETEEN',
      20 => 'TWENTY',
      30 => 'THIRTY',
      40 => 'FORTY',
      50 => 'FIFTY',
      60 => 'SIXTY',
      70 => 'SEVENTY',
      80 => 'EIGHTY',
      90 => 'NINETY'
  );

  if ($number < 10) {
      return $words[$number];
  } elseif ($number < 20) {
      return $specialWords[$number];
  } elseif ($number < 100) {
      return $specialWords[10 * floor($number / 10)] . ($number % 10 ? ' ' . $words[$number % 10] : '');
  } elseif ($number < 1000) {
      return $words[floor($number / 100)] . ' HUNDRED' . ($number % 100 ? ' AND ' . convertToWords($number % 100) : '');
  } elseif ($number < 1000000) {
      return convertToWords(floor($number / 1000)) . ' THOUSAND' . ($number % 1000 ? ' ' . convertToWords($number % 1000) : '');
  } else {
      return 'Number out of range';
  }
}

$numericValue = $order->total_amount;
$wordValue = strtoupper(convertToWords($numericValue));


    ?>

<body onload="window.print();">

        <div class="content p-4">
            <div class="row-1">
                <div class="row">

                    <div class="col-lg-3">
                        <div class="logoImg">
                            <img src="{{ asset('uploads/setting/'.$settings->logo_path) }}" alt="logo"
                                class="img-fluid">
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="midContent text-center">
                            <h1>{{$settings->title ?? ''}}</h1>
                            <h4>{{$settings->address ?? ''}} </h4>
                            <p>{{$settings->address2 ?? ''}}</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="sideContent text-left">
                            <p>Phone : {{$settings->phone ?? ''}}</p>
                            <p>Email : {{$settings->email ?? ''}}</p>
                            <p>GSTIN : {{$settings->gstin ?? ''}}</p>
                        </div>
                    </div>

                </div>
            </div>

            <hr>
            <div class="divider"></div>

            <div class="row-2">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="child-1">
                            <p><strong>To:</strong> {{$order->first_name ?? ''}} {{$order->last_name ?? ''}}</p>
                            <p><strong>Contact No:</strong> {{$order->phone ?? ''}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="child-2">
                            <p><strong>Invoice No:</strong> {{$order->order_number ?? ''}}</p>
                            <p><strong>Date:</strong> {{date('d-M-Y')}}</p>
                            <p><strong>Address:</strong> {{$order->address ?? ''}}, {{$order->pin_code ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-3">
                <div class="tableArea">
                    <table class="table-box">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">S.No.</th>
                                <th scope="col">Products</th>
                                <th scope="col">Qty</th>
                                <th scope="col">M.r.p</th>
                                <th scope="col">Price</th>
                                <th scope="col">gst(%)</th>
                                <th scope="col">Vender</th>
                            </tr>
                        </thead>
                        <tbody>

                        @php $quantity = $key_count = 0; @endphp
                          @if($order->product_detail != null && $order->product_detail !='')                                        
                          @foreach(json_decode($order->product_detail) as $key=> $subphotos2) 
                          @if($key == $theme)
                          @foreach($subphotos2 as $subphotos3)
                          @foreach($subphotos3 as $key2 => $subphotos)
                          @php $product = DB::table('products')->where('id',$subphotos->product_id)->first() @endphp
                          @php $quantity += $subphotos->quantity; @endphp
                          @php $key_count++; @endphp
                          <tr>
                          <td>{{$key_count}}</td>
                              <td>                                
                                      @if(!empty($product))  
                                      {{$product->title}} @if($subphotos->weight) ({{$subphotos->weight}}) @endif
                              </td>
                              <td>{{$quantity}}</td>
                              <td>{{$subphotos->mrp ?? ''}}</td>  
                              <td>{{$subphotos->price ?? ''}}</td>               
                              <td>18 %</td>               
                              <td>
                                  @if(is_numeric($order->vender))
                                      @if($vender = DB::table('saller')->where('id',$order->vender)->first())
                                      {{$vender->company_name ?? ''}}
                                      @else
                                          ---
                                      @endif
                                  @else
                                    Admin
                                  @endif
                              </td>
                              </tr>    
                              @endif
                              @endforeach
                              @endforeach
                              @endif
                            @endforeach
                            @endif
                        </tbody>
                        <tbody>
                            <tr>
                                <th scope="row" class="tdata"></th>
                                <th scope="row" class="tdata"></th>
                                <th scope="row" class="tdata">Sub Total : ₹{{number_format($order->sub_total,2)}}</th>
                                <th scope="row" class="tdata"></th>
                                <th scope="row" class="tdata"></th>
                                <th scope="row" class="tdata"></th>
                                <th scope="row" class="tdata"></th>
                            </tr>
                        </tbody>

                        <tbody>
                            <tr>
                                <th scope="row" class="tdata" colspan="5">In Words : {{$wordValue}} only</th>
                                <td><strong>Grand Total (₹)</strong> : {{number_format($order->total_amount,2)}}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <p>By placing this order customer has agreed, not to return any past order as per terms & conditions and company policy.</p>
            </div>

        </div>

<script>
  setTimeout(function() {
    window.history.back();
}, 5000);

</script>    


</body>

</html>