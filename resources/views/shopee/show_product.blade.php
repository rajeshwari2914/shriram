@extends('shopee.header')
@section('index-content')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Product</h1>
                        <!--<h1 class="page-subhead-line">This is dummy text , you can replace it with your original text. </h1>-->
						
                    </div>
                </div>
                <!-- /. ROW  -->
              
            <div class="row">
			
			<br><br>
                <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Product
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                        <tr>
                                            <th>Id</th><td>{{$cate1->id}}</td>
                                        </tr>    
                                        <tr><th>Product Name</th> <td>{{$cate1->pname}}</td></tr>
                                        <tr><th>Product Code</th><td>{{$cate1->pcode}}</td></tr>
                                        <tr><th>Category</th><td>{{$cate1->category}}</td></tr>
                                        <tr><th>Description</th><td>{{$cate1->des}}</td></tr>
										<tr><th>Image</th>	<td>
												<?php 
						$demo=json_decode($cate1->img);
						//exit();
					
					for($i=0;$i<sizeof($demo);$i++){?>
                                            	

                							<?php
                                                if(strpos($demo[0],'https:')!==false){?>
                                                <img src="{{ $demo[$i] }}" alt="pro-img1" class="img-fluid image" style="height:100px;width:100px;">
                                            <?php } else {?>
                                                <img src="{{ asset('/product_images/'.$demo[$i]) }}" alt="pro-img1" class="img-fluid image" style="height:30px;width:30px;">
                                                    <?php }
                					                }
                                                    ?>
					
					
					
					</td></tr>
                                            <tr><th>MRP</th><td>{{$cate1->price_sale}}</td></tr>
                                            <tr><th>Discount</th><td>{{$cate1->discount}} % </td></tr>
                                            <tr><th>Price Purchase</th> <td>{{$cate1->price_purchase}}</td></tr>
                                            <tr><th>Margin</th><td>{{$cate1->margin}}</td></tr>
                                            
                                            <tr><th>Hsn Code</th><td>{{$cate1->hsn}}</td></tr>
                                            <tr><th>GST</th><td>{{$cate1->gst}}</td></tr>
											<tr><th>Fetures</th><td><p>{!! html_entity_decode($cate1->des) !!}</p>
                    @if($cate1->features!="no")
												 <div class="title" style="margin-top:15px;">
												<h2>Features</h2>
												</div>
                                                <p>{{$cate1->features}}</p>
												@endif
												@if($cate1->safety_information!="no")
												 <div class="title" style="margin-top:15px;">
												<h2>Information</h2>
												</div>
                                                <p>{{$cate1->safety_information}}</p>
												@endif
												@if($cate1->ingredients!="no")
												 <div class="title" style="margin-top:15px;">
												<h2>Ingredients</h2>
												</div>
                                                <p>{{$cate1->ingredients}}</p>
												@endif
												
												@if($cate1->directions!="no")
												 <div class="title" style="margin-top:15px;">
												<h2>Directions</h2>
												</div>
                                                <p>{{$cate1->directions}}</p>
												@endif
												
												@if($cate1->legal_disclaimer!="no")
												 <div class="title" style="margin-top:15px;">
												<h2>Disclaimer</h2>
												</div>
                                                <p>{{$cate1->legal_disclaimer}}</p>
												@endif</td></tr>
                                        </tr>
                                        <tr><th>Brand</th><td>{{$cate1->brands}}</td></tr>
                                        <tr><th>Packing</th><td>{{$cate1->packing}}</td></tr>
                                        <tr><th>Status</th><td>{{$cate1->status}}</td></tr>
                                    
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
    @stop
