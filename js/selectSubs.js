$(function() {     

    //alert("page loaded");
    $('#add_event').submit(function(event) {


        var div = document.getElementById("loading");
            div.style.display = "inline";
       
       $.ajax( {
  type: 'POST',
  url: 'php/add_event.php',
  data: new FormData( this ),
  processData: false,
  contentType: false,
  cache: false,
  success:function(result){                     
                    alert(result);  
                    $('html,body').scrollTop(0);
                    location.reload();            
                   
                                      

                 }
});

    //next line: end of ajax
    });
//next line: end of script
}); 