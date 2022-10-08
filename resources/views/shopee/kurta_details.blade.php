@extends('shopee.header')
@section('index-content')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Customer Details</h1>
                        <!--<h1 class="page-subhead-line">This is dummy text , you can replace it with your original text. </h1>-->
						
                    </div>
                </div>
                <!-- /. ROW  -->
              
            <div class="row">
			<!-- <div class="col-md-6">
				<a href="{{route('products.create')}}" style="text-decoration:none;color:white;"><button class="col-md-12 btn btn-info" type="submit">Add Product</button></a>
			</div> -->
			<!-- <div class="col-md-6">
				<form action="/importproduct" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                
                <button class="btn btn-success">Import Product Data</button>
				<br><br>
				</form>
			</div> -->
			<br><br>
                <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Short Kurta Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Customer Name</th>
                                            <th>Contact</th>
											<!-- <th>Description</th>
											<th>Iron</th>
                                            <th>Ring</th>
                                            <th>Pendri Major</th> -->
                                            <th>Order Date</th>
                                            <th>Delivery Date</th>
                                            <th>Material</th>
                                            <th>Material Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Advance Amount</th>
                                            <th>Remaning Amount</th>
											<th>Oprations</th>
											
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$i=1;
									?>
									@foreach($paint as $cate)
                                        <tr>
                                            <td>{{$cate->id}}</td>
                                            
                                            <td>{{$cate->name}}</td>
                                            <?php
                                            $cate_p=$cate->total_amt;
                                            $ad=$cate->advance_amt;
                                            $rem=$cate_p-$ad;
                                            ?>
                                            <td>{{$cate->mobile}}</td>
<!-- 										
                				
                					        <td><p style="word-spacing:1cm;line-height:500%;">{{$cate->desc}}</p></td>
					                        <td>{{$cate->estri}}</td>
                                            <td>{{$cate->ring}}</td>
                                            <td>{{$cate->pendri}}</td> -->
                                            <td>{{$cate->order_date}}</td>
                                            <td>{{$cate->delivery_date}}</td>
                                            <td>{{$cate->material}}</td>
                                            <td>{{$cate->material_qty}}</td>
                                            <td>{{$cate->total_amt}}</td>
                                            <td>{{$cate->advance_amt}}</td>
                                            <td><button class="btn btn-warning">{{$rem}}</button></td>
											<td>
											<form action="{{route('details.destroy',$cate->id)}}" method="post">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger">Delete</button>
											</form>
											<br>
											<a href="{{route('details.edit',$cate->id)}}" style='text-decoration:none;color:black;'><button type='submit'  class="btn btn-primary">Update</button></a>
											<br><br>
											<a href="printbill/{{$cate->id}}"><button class="btn btn-success">Print</button></a></td>
                                        </tr>
                                        <?php $i++;?>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
               
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--  end  Context Classes  -->
                </div>
            </div>
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        // For the example - show interactions with the table
var eventFired = function ( type ) {
    var n = document.querySelector('#demo_info');
    n.innerHTML += '<div>'+type+' event - '+new Date().getTime()+'</div>';
    n.scrollTop = n.scrollHeight;     
}
 
document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#datatables');
 
    table
        .on('order', function () {
            eventFired( 'Order' );
        })
        .on('search', function () {
            eventFired( 'Search' );
        })
        .on('page', function () {
            eventFired( 'Page' );
        });
});
    </script>
@stop