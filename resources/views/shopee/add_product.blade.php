@extends('shopee.header')
@section('index-content')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Customer Form</h1>
                        <!--<h1 class="page-subhead-line">This is dummy text , you can replace it with your original text. </h1>-->

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                           Customer Form
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="{{route('details.store')}}" enctype="multipart/form-data">
							
							@csrf
                                <div class="col-md-12">
                                        <div class="col-md-6">
							            <div class="form-group">
                                            <label>Customer Name</label>
                                            <input class="form-control" type="text" name="cname" required>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input class="form-control" type="text" name="contact" maxlength="10" pattern="/^[0-9]{10}*/" title="Enter Valid Number">
										</div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea class="form-control" id="summernote" name="desc"></textarea>
                                            </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-control" type="text" name="iron" required>
                                                <option>CD उभी इस्त्री</option>
                                                <option>साईड पाॅकीट दोन प्लेट</option>
                                                <option>CD अडवी इस्त्री</option>
                                            </select>
									</div>
                                    </div>
                                        <div class="col-md-4">
							            <div class="form-group">
                                            <label>Ring</label>
                                            <input class="form-control" type="text" name="ring" required>
										</div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pendri Major</label>
                                            <input class="form-control" type="text" name="pendri" required>
										</div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="col-md-6">
							            <div class="form-group">
                                            <label>Order Date</label>
                                            <input class="form-control" type="date" name="odate" required>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Delivery Date</label>
                                            <input class="form-control" type="date" name="ddate" required>
										</div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="col-md-6">
							            <div class="form-group">
                                            <label>Shirt Quantity</label>
                                            <input class="form-control shirt_id" type="number" name="shirt_qty" required>
                                            <input class="form-control shirt_total" type="hidden" name="" required>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Paint Quentity</label>
                                            <input class="form-control paint_id" type="number" name="paint_qty" required>
										</div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="col-md-6">
							            <div class="form-group">
                                            <label>Total Amount</label>
                                            <input class="form-control total" type="text" name="total" required>
                                            
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Advanced Amount</label>
                                            <input class="form-control" type="text" name="advance_amt" required>
										</div>
                                        </div>
                                </div>
                                        
                                    <center><button type="submit" class="btn btn-info" style="padding:10px;width:20%;">Add Customer Details</button></center>
                                </form>
                            </div>
                        </div>
                            </div>


        </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
<script>
$(document).ready(function(){

    $(".shirt_id").on('change',function(){
        var id=$(this).val();
        //alert(id);
        var stotal=350*id;
        
        $('.shirt_total').val(stotal);    
		var total=$('.shirt_total').val();
        $('.total').val(total);
        //$('.total').val(stotal);
    });
    //alert(st);
    $(".paint_id").on('change',function(){
        var pid=$(this).val();
        var ptotal=400*pid;
       // alert(ptotal);
        // if(pid=='1')
        // {
        //         var total=$('.total').val();
       
        //     var finaltotal=parseInt(total) + parseInt(ptotal);
        //     $('.total').val(finaltotal);
        // }
        // else
        // {
        //     //var mi=pid-1;
            //var hj=400*pid;
            
            var total=$('.shirt_total').val();
       //alert(total);
            var finaltotal=parseInt(total) + parseInt(ptotal);
            //alert(finaltotal);
            $('.total').val(finaltotal);
        //}
       
    });
    $('#summernote').summernote();
});
</script>

   @stop