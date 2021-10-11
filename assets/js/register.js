$("select#sports").on("change", function () {
  var number = $(this).children("option:selected").val();
  var players = "<label><b>No. of players</label>";  
  var players2 =   "<label><b>Select type</b></label>";
  var cricket1 =  '<select ><option value="0">11</option></select>';
  var chess1  =  '<select ><option value="0">1</option></select>';
  var tt1  =  '<select id="types"><option value="0">Select an option</option><option value="1">Singles</option><option value="2">Doubles</option></select>';
  var bad1  =  '<select id="types"><option value="0">Select an option</option><option value="1">Singles</option><option value="2">Doubles</option></select>';
  var play = '<div id="pn"><label for="single"><b>Enter Captain Name</b></label>';
  var play1 = '</p><input type="text" placeholder="Enter Captain name" id="single" name="single" required></div><br>';
  $("#showtype").html('');
  $("#total").html('');

  var html = '';
  if (number == 1){
    $('#total label').remove();
    var add = '';
    html = players + cricket1 ;
    add = play +play1;
    amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹330<b></label>';
    $('#showtype').append(html+add);

    $("#total").append(amount);
    
  }
  else if(number == 2){
    html = players2 + bad1;
    $('#showtype').append(html);
    var add = '';
    var add1 = '';
    
    $("select#types").on("change", function () {
      
      var aakda = $(this).children("option:selected").val();
      var singlelabel = '<div id="pn"><label for="single"><b>Enter player Name</b></label>';
      var single = '</p><input type="text" placeholder="Enter Player name" id="single" name="single" required></div><br>';
      if (aakda == 0){
        
          alert ('Select a valid option');
          $('#showtype div').remove(); 
        } 
     else if (aakda == 1){
      $('#showtype div').remove(); 
      $('#total label').remove();
          amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
          add = singlelabel + single;
          $('#showtype').append(add);
          $("#total").append(amount);
        }
        else if(aakda == 2){
          $('#showtype div').remove(); 
          $('#total label').remove();
          amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹60<b></label>';
          add = singlelabel + single;
          add1 = singlelabel + single
          $('#showtype').append(add + add1);
          $("#total").append(amount);
        }
        else{
          alert ('Select a valid option');
          $('#showtype div').remove(); 
        }
        });
   

   
  }
  else if(number == 3){
     html = players2 + tt1;
     $('#showtype').append(html);
    var add = '';
    var add1 = '';
    var amount = '';
    
    $("select#types").on("change", function () {
      
      var aakda = $(this).children("option:selected").val();
      var singlelabel = '<div><label for="single"><b>Enter player Name</b></label>';
      var single = '<input type="text" placeholder="Enter Player name" id="single" name="single" required</div>';
      if (aakda == 0){
          alert ('Select a valid option');
          $('#showtype div').remove(); 
        } 
     else if (aakda == 1){
      $('#showtype div').remove(); 
      $('#total label').remove();
      amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
          add = singlelabel + single;
          $('#showtype').append(add);
          $("#total").append(amount);
        }
        else if(aakda == 2){
          $('#showtype div').remove(); 
          $('#total label').remove(); 
          amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹60<b></label>';
          add = singlelabel + single;
          add1 = singlelabel + single
          $('#showtype').append(add + add1);
          $("#total").append(amount);
        }
        else{
          alert ('Select a valid option');
          $('#showtype div').remove(); 
        }
        });
   
  }
  else if(number == 4){
    $('#total label').remove();
    html = players + chess1;
    add = play +play1;
    amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
    $('#showtype').append(html+add);
    $("#total").append(amount);
  }
  else {
   alert('Select a valid option to proceed');
    
  }
});