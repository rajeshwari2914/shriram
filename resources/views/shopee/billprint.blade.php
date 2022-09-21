<html>
    <head>
        <title>Bill Form</title>
    </head>
    <body>
        <div style="height:auto;width:50%;margin:auto;border:1px solid black;">
        <!-- <div style="width:20%;float:left;"><img src="{{asset('images/Sriram-design-amped-name.png')}}" style="height:150px;width:150px;margin-left:5%;"></div> -->
        <div style="width:100%;margin:auto;border:2px solid red;float:right;height:180px;margin:auto;border:none;">
        <center><h1>Shriram Tailer</h1></center>
        <center><h4 style="margin-top:-20px;">Jents Specilist</h4></center>
        <p style="margin-top:-15px;" align="center">Kanna Chowk,Choudeshwar Pathpeddhi, Siddeshwar Loundri Near, 335, Jhodbhavi Peth, VRL Transport Front, Solapur</p>
        <center><p style="margin-top:-10px;"><b>Contact: 9175720799</b></p></center><br><br>
        </div>
        <table style="height:auto;width:100%;margin-top:5%;" border="1">
            <tr style="border:none;height:50px;">
                <td colspan="4">Name : {{$shri[0]->name}}</td>
            </tr>
            <tr style="border:none;height:50px;">
                <td colspan="4">Contact : {{$shri[0]->mobile}}</td>
            </tr>
            <tr style="height:50px;">
                <th>Category Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <tr style="height:100px;">
                <td>Shirt</td>
                <td>{{$shri[0]->desc}}</td>
                <td>{{$shri[0]->shirt_qty}}</td>
                <td>{{$shri[0]->total_amt}}</td>
            </tr>
            <tr>
                <td colspan="4">Total:</td>
            </tr>
        </table>    
    </div>

    </body>
</html>