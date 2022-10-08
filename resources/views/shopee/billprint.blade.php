<html>
    <head>
        <title>Bill Form</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
    </head>
    <body>
        <div style="height:auto;width:55%;margin:auto;border:1px solid black;" id="maindiv">
        <!-- <div style="width:20%;float:left;"><img src="{{asset('images/Sriram-design-amped-name.png')}}" style="height:150px;width:150px;margin-left:5%;"></div> -->
        <div style="width:100%;margin:auto;border:2px solid red;float:right;height:80px;margin:auto;border:none;">
        <center><h3>ShreeRam Tailor</h3></center>
        <center><h4 style="margin-top:10px;">Gents Specialist</h4></center>
        
        </div>
        <hr style="width:100%;margin:auto;">
        <div style="height:30px;border:1px solid green;border:none;margin-top:5%;"><span><p style="margin-left:5%;font-weight:bold;float:left;">Bill No : ST-01</span><span><p style="margin-right:5%;font-weight:bold;float:right;">Order Date : {{$shri[0]->order_date}}</span></div>
        <div style="height:30px;border:1px solid green;border:none;"><span><p style="margin-left:5%;font-weight:bold;float:left;">Material Quantity : {{$shri[0]->material_qty}} ( {{$shri[0]->material}} )</span><span><p style="margin-right:5%;font-weight:bold;float:right;">Trial Date : {{$shri[0]->delivery_date}}</span></div>
        
        
        <table style="height:auto;width:100%;margin-top:0%;border-collapse:collapse;" class="table table-bordered">
            <tr style="height:20px;">
                <th><center>Measurement</center></th>
                
            </tr>
            <tr style="height:100px;">
                
                <td><p style="word-spacing:1cm;line-height:400%;letter-spacing:5px;">{{$shri[0]->desc}}</p></td>
                
            </tr>
            <!-- <tr>
                <td><p style="float:right">Total:</p></td>
                <td>{{$shri[0]->total_amt}}</td>
            </tr> -->
        </table> 
        <?php
        $estri=$shri[0]->estri;
        if($estri!="no")
        {
        ?>
        <h5 style="margin-left:5%;"><b>{{$shri[0]->estri}}</b></h5>   
        <?php
        }else{
        }
        ?>

        <hr style="color:black;">
        <div style="width:100%;height:110px;border:1px solid black;margin:auto;border:none;"><p style="margin-top:15px;line-height:20px;margin-left:5%;" align="center" >Kanna Chowk,Choudeshwar Pathpeddhi, Siddeshwar Loundri Near,<br> 335, Jhodbhavi Peth, VRL Transport Front, Solapur</p>
        <center><p style="margin-top:0px;"><b>Contact: 9175720799</b></p></center><br><br>
        
        </div>
        
    </div>
    <!-- <button onClick="MyFunction()">print</button> -->
    <!-- <script>
        function MyFunction(){
            var test=document.getElementById('maindiv').innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Div contents are <br>');
            a.document.write(test);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script> -->
    </body>
</html>