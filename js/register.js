function submitData(e){
    $(document).ready(function(){
      var data = {
        name: $("#name").val(),
        username: $("#username").val(),
        password: $("#password").val(),
        Email: $("#Email").val(),
        action: $("#action").val(),
      };
      if( data.name===""||data.username === "" || data.password === "" ||data.Email==="" ){
        return;
      }
  
      $.ajax({
        url: 'php/register.php',
        type: 'post',
        data: data,
        success:function(response){
          alert(response);
          if(response == "Login Successful"){
            location.replace("login.html");
          }
        }
      });
    });
  }
