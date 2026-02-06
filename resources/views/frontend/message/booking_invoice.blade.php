<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css"> 
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: blue;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: blue;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <h2 style="color: blue; font-size: 26px;"><strong>MyFixIt</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               MyFixIt 
               Email: {{ $siteSettings->email }} <br>
               Phone: {{ $siteSettings->support_phone }} <br>
               {{ $siteSettings->company_address }} <br>
            </pre>
        </td>
    </tr>
  </table>

  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{ $invoice['user']['name'] }} <br>
           <strong>Email:</strong> {{ $invoice['user']['email'] }} <br>
           <strong>Phone:</strong> {{ $invoice['user']['phone'] }} <br>
           <strong>Address:</strong> {{ $invoice['user']['address'] }}  
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: blue;">Invoice:</span> #{{ $invoice['invoice'] }}</h3>
            Order Date: {{ $invoice['created_at'] }} <br> 
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Service Booking Details</h3>

  <table width="100%">
    <thead style="background-color: blue; color:#FFFFFF;">
      <tr class="font">
        <th>Service Name </th>
        <th class="text-end">Technician Name</th>
        <th class="text-end">Service Date</th>
        <th class="text-end">Booking Time</th>
        <th class="text-end">Service Fee</th>
        <th class="text-end">Total</th>
      </tr>
    </thead>
    <tbody>
      <tr class="font">
         <td align="center"> {{ $invoice['service']['service_name'] }}</td>
         <td align="center">{{ $invoice['technician']['name'] }}</td>
        <td align="center">{{ $invoice['booking_date'] }}</td>
        <td align="center">{{ $invoice['booking_time'] }}</td>
        <td align="center">RM {{ $invoice['confirm_fee'] }}</td>
        <td align="center">RM {{ $invoice['confirm_fee'] }}</td>
      </tr>
    </tbody>
  </table>

  <div class="thanks mt-3">
    <p>Thanks for booking a service with MyFixIt..!!</p>
  </div>

  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>

</body>
</html>