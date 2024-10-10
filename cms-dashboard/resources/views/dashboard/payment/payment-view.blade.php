@extends('layout.base')

@section('content')
<div class="row">
    <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
          </div>
          @if(session('messageAlert'))
         <div class="bd-example">
            <div class="alert alert-left alert-{{session('messageAlert.type')}} alert-dismissible fade show mb-3" role="alert"> {{-- success/info/warning/danger --}}

               <span> {{session('messageAlert.message')}}</span>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         </div>
         @endif
          <div class="card-body">
             <div class="custom-datatable-entries">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                   <thead>
                      <tr>
                         <th>User</th>
                         <th>Total Price</th>
                         <th>Payment Method</th>
                         <th>Date Payment</th>
                         <th>Status</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{ $data->order->user->username }}</td>
                        <td>{{ $data->order->total_price }}</td>
                        <td>{{ $data->paymentMethod->payment_method_name }}</td>
                        <td>{{ $data->date_payment }}</td>
                        <td><span class="badge bg-{{$data->payment_status=='SUCCESS'?'success':($data->payment_status=='PENDING'?'info':'danger')}}">{{ $data->payment_status }}</span></td>
                        <td>
                           <div class="flex align-items-center list-user-action">
                              <a class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail" href="{{ route('payment.detail', $data->id) }}">
                                 <span class="btn-inner">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: translateY(2px);"> <!-- Adjusted translation -->
                                         <!-- White magnifying glass -->
                                         <path fill="white" d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z"/>
                                     </svg>
                                 </span>
                             </a>                             
                            </div>
                       </td>
                    </tr>
                    @endforeach
                   </tbody>
                   <tfoot>
                      <tr>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Date Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                   </tfoot>
                </table>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection