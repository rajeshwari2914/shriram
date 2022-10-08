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
                            <form  method="post" action="{{route('details.store')}}" enctype="multipart/form-data">
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
                                            <input class="form-control" type="text" name="contact" pattern="[0-9]{10}" title="Enter Valid Number">
										</div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="col-md-4">
							            <div class="form-group">
                                            <label>Select Material</label>
                                            <!-- <input class="form-control shirt_id" type="number" name="shirt_qty" required>
                                            <input class="form-control shirt_total" type="hidden" name="" required> -->
                                            <select class="form-control materialname" type="text" name="material" required>
                                                <option value="">Select Material</option>
                                                <option value="Shirt">Shirt</option>
                                                <option value="Paint">Paint</option>
                                                <option value="Kurta">Short Kurta</option>
                                                <option value="Nehru_shirt">Nehru Shirt</option>
                                            </select>
										</div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea class="form-control summernote" style="word-spacing:1cm;padding-top:1cm;line-height: 500%;letter-spacing:5px;" name="desc"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea class="form-control summernote" style="word-spacing:1cm;padding-top:1cm;line-height: 500%;" name="desc"></textarea>
                                            </div>
                                    </div>
                                    
                                </div> -->
                                <div class="col-md-12 paintpoint" style="display:none;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                            <label>Select</label>
                                            <select class="form-control" type="text" name="iron">
                                                <option>CD उभी इस्त्री</option>
                                                <option>साईड पाॅकीट दोन प्लेट</option>
                                                <option>CD अडवी इस्त्री</option>
                                            </select>
									</div>
                                    </div>
                                        <!-- <div class="col-md-4">
							            <div class="form-group">
                                            <label>Ring</label>
                                            <input class="form-control" type="text" name="ring" required>
										</div>
                                        </div> -->
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pendri Major</label>
                                            <input class="form-control" type="text" name="pmap">
										</div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ring</label>
                                            <input class="form-control" type="text" name="ring">
										</div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Paint Quantity</label>
                                            <input class="form-control material_pqty" type="number" name="pqty">
										</div>
                                        </div>
                                </div>

                                <div class="col-md-12 shirtpoint" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Collar Size</label>
                                            <input class="form-control" type="text" name="collar_size">
									</div>
                                    </div>
                                        <!-- <div class="col-md-4">
							            <div class="form-group">
                                            <label>Ring</label>
                                            <input class="form-control" type="text" name="ring" required>
										</div>
                                        </div> -->
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Shirt Quantity</label>
                                            <input class="form-control material_qty" type="number" name="mqty">
										</div>
                                        </div>
                                </div>

                                <div class="col-md-12 kurtapoint" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Bound Patti Size</label>
                                            <input class="form-control" type="text" name="bound_size">
									</div>
                                    </div>
                                        <!-- <div class="col-md-4">
							            <div class="form-group">
                                            <label>Ring</label>
                                            <input class="form-control" type="text" name="ring" required>
										</div>
                                        </div> -->
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control material_kqty" type="number" name="kqty">
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
                                            <label>Total Amount</label>
                                            <input class="form-control total" type="text" name="total" required>
                                            
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Advanced Amount</label>
                                            <input class="form-control" type="text" name="advance_amt" value="0" required>
										</div>
                                        </div>
                                </div>
                                        
                                    <center><input type="submit" class="btn btn-info" style="padding:10px;width:20%;" value="Add Customer Details"></center>
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
    $(".materialname").on('change',function(){
        var id=$(this).val();
        
        if(id=='Shirt')
        {
            $('.shirtpoint').css("display","block");
            $('.paintpoint').css("display","none");
            $('.kurtapoint').css("display","none");

        }
        else if(id=='Paint')
        {
            $('.paintpoint').css("display","block");
            $('.shirtpoint').css("display","none");
            $('.kurtapoint').css("display","none");
        }else if(id=='Kurta' || id=='Nehru_shirt')
        {
            $('.paintpoint').css("display","none");
            $('.shirtpoint').css("display","none");
            $('.kurtapoint').css("display","block");
        }
    });
    $(".material_qty").on('change',function(){
        var mate=$('.materialname').val();
        var mid=$(this).val();
        //alert(id);
            if(mate=='Shirt')
            {
                var stotal=350*mid;
                $('.total').val(stotal);    
                // var total=$('.material_qty').val();
                // $('.total').val(total);
                //$('.total').val(stotal);
            }

    });
    $(".material_pqty").on('change',function(){
        var mate=$('.materialname').val();
        var mid=$(this).val();
        //alert(id);
            if(mate=='Paint')
            {
                var stotal=400*mid;
                $('.total').val(stotal);    
                // var total=$('.material_qty').val();
                // $('.total').val(total);
                //$('.total').val(stotal);
            }

    });
    $(".material_kqty").on('change',function(){
        var mkid=$(this).val();
        var ktotal=350*mkid;
        $('.total').val(ktotal);
    })

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
   
});

</script>
@stop