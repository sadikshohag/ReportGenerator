      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#down_date").datepicker();  
                //$("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var down_date = $('#down_date').val();  
                //var to_date = $('#to_date').val();  
                if(down_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{down_date:down_date},  
                          success:function(data)  
                          {  
                               $('#daily_data').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      }); 