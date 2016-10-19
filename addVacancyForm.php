<html>
<head>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link href="css/jquery-1.10.4-ui.css" rel="stylesheet">
<script src="js/jquery-1.10.4-ui.js"></script>

      <!-- CSS -->
      <style>
         .ui-widget-header,.ui-state-default, ui-button{
            background:#6dc7cd;
            border: 1px solid #6dc7cd;
            color: #FFFFFF;
            font-weight: bold;
         }
      </style>

</head>
<body>
<h2>Add Vacancies:-</h2>
<form action="addVacancy.php" method="post">
<table border=1 style="background-color:#D8D8D8">
<tr><td>Title</td><td><input type="text" name="title"></td></tr>
<tr><td>City</td><td><input type="text" name="city"></td></tr>
<tr><td>Description</td><td><textarea name="description" rows="4" cols="50"></textarea></td></tr>
<tr><td>Skill Set:</td><td><textarea name="skillSet" rows="4" cols="50"></textarea></td></tr>
<tr><td>Work Experience: </td><td><textarea name="workEx" rows="4" cols="50"></textarea></td></tr>
<tr><td>Salary Range: </td><td><input type="text" name="salaryRange"><br></td></tr>
<tr><td>Job Type: </td><td><input type="text" name="jobType"><br></td></tr>
<tr><td>Passcode</td><td><input type="text" name="passcode" placeholder="Enter unique passcode."></td></tr>
<tr><td><input type="submit" value="Submit"></td><td><input type="reset" value="Reset"></td></tr>

</form>

<table border=1 id="vacanciesTab">
<tr>
<td>Title</td>
<td>City</td>
<td>Description</td>
<td>Skill Set</td>
<td>Work Ex</td>
<td>Salary Range</td>
<td>Job Type</td>
<td>Created Time</td>
<td>Delete/Update</td>
</tr>
</table>

<div id="delete-dialog" title="Delete Vacancy">These items will be permanently deleted and cannot be recovered. Are you sure?</div>
<div id="update-dialog" title="Update Vacancy">

  <div id="submain">
    <div id="sub-left">Title:</div> 
    <div id="sub-right"><input type="text" id="dialog-title"></div>
  </div>
  <div id="submain">
    <div id="sub-left">City:</div> 
    <div id="sub-right"><input type="text" id="dialog-city"></div>
  </div>
  <div id="submain">
    <div id="sub-left">Description:</div> 
    <div id="sub-right"><textarea id="dialog-description" rows="4" cols="50"></textarea></div>
  </div>
  <div id="submain">
    <div id="sub-left">Skill Set:</div> 
    <div id="sub-right"><textarea id="dialog-skillSet" rows="4" cols="50"></textarea></div>
  </div>
  <div id="submain">
    <div id="sub-left">Work Experience:</div> 
    <div id="sub-right"><textarea id="dialog-workEx" rows="4" cols="50"></textarea></div>
  </div>
  <div id="submain">
    <div id="sub-left">Salary Range:</div> 
    <div id="sub-right"><input type="text" id="dialog-salaryRange"></div>
  </div>
  <div id="submain">
    <div id="sub-left">Job Type:</div> 
    <div id="sub-right"><input type="text" id="dialog-jobType"></div>
  </div>
  <div id="submain">
    <div id="sub-left">Passcode:</div> 
    <div id="sub-right"><input type="text" id="dialog-passcode" placeholder="Enter unique passcode."></div>
  </div>
  
</div>

<script type="text/javascript">
  $.get("addVacancy.php", function(data, status){
  data = JSON.parse(data)
  for(i=0; i<data.length; i++){
    $('#vacanciesTab').append('<tr><td>'+data[i]['title']+'</td><td>'+data[i]['city']+'</td><td>'+data[i]['description']+'</td><td>'+data[i]['skillSet']+'</td><td>'+data[i]['workEx']+'</td><td>'+data[i]['salaryRange']+'</td><td>'+data[i]['jobType']+'</td><td>'+data[i]['createdTime']+'</td><td><a id="delete-'+data[i]['id']+'" href="#'+data[i]['id']+'">Delete</a> / <a id="update-'+data[i]['id']+'" href="#'+data[i]['id']+'">Update</a></td></tr>');
  }
        
        //Dialog delete/update click event once table is formed.
        $("#delete-dialog").dialog({
               autoOpen: false,
               modal: true,
               show: {
          effect: "blind",
          duration: 1000
          },
         hide: {
          effect: "explode",
          duration: 1000
         },
               buttons: {
          "Delete item": function() {
            var url = window.location.href;
            var id = url.split("#")[1];
            $.ajax({
              url: "addVacancy.php",
      data: {
        operation:"delete",
        id: id
      },
          type: "GET"
            }).done(function( json ) {
              console.log(json);
              window.location.reload() 
            }).fail(function(xhr, status, errorThrown){
              console.log(errorThrown);             
            });
              $( this ).dialog( "close" );
          },
          Cancel: function() {
            $( this ).dialog( "close" );
          }
               }  
        });
        $("#update-dialog").dialog({
               autoOpen: false,
               modal: true,
               width:"auto",
               open:function(event, ui){
          var id = $(event.target).attr('tempid');
                $.ajax({
              url: "addVacancy.php",
      data: {
        operation:"getById",
        id: id
      },
          type: "GET"
            }).done(function( json ) {
              console.log(JSON.parse(json));
              json = JSON.parse(json);
              $("#dialog-title").val(json[0]['title']);
            $("#dialog-city").val(json[0]['city']);
            $("#dialog-description").val(json[0]['description']);
            $("#dialog-skillSet").val(json[0]['skillSet']);
            $("#dialog-workEx").val(json[0]['workEx']);
            $("#dialog-salaryRange").val(json[0]['salaryRange']);
            $("#dialog-jobType").val(json[0]['jobType']);
            
            }).fail(function(xhr, status, errorThrown){
              console.log(errorThrown);             
            });
               },
               buttons: {
          "Update item": function() {
            var url = window.location.href;
            var id = url.split("#")[1];
            $.ajax({
              url: "addVacancy.php",
      data: {
        operation:"update",
        id: id,
        title:$("#dialog-title").val(),
        city:$("#dialog-city").val(),
        description:$("#dialog-description").val(),
        skillSet:$("#dialog-skillSet").val(),
        workEx:$("#dialog-workEx").val(),
        salaryRange:$("#dialog-salaryRange").val(),
        jobType:$("#dialog-jobType").val(),
        passcode:$("#dialog-passcode").val(),
      },
          type: "POST"
            }).done(function( json ) {
              console.log(json);
              window.location.reload() 
            }).fail(function(xhr, status, errorThrown){
              console.log(errorThrown);             
            });
              $( this ).dialog( "close" );
          },
          Cancel: function() {
            $( this ).dialog( "close" );
          } 
        } 
        });
        $('a[id^=delete]').click(function() {
               $("#delete-dialog").dialog( "open" );
        });
        $('a[id^=update]').click(function() {
          $("#update-dialog").attr('tempId', $(this).attr('id').split("-")[1]);
               $("#update-dialog").dialog( "open" );
        });
    });
</script>

</body>
</html>