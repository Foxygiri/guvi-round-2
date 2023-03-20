function submitData(){
  
    $(document).ready(function(){
      var data = {
        username: $("#username").val(),
        password: $("#password").val(),
      };
      // alert(data.)
      if(data.username === "" || data.password === ""){
        // alert(data)
        alert("Please fill in all the detials")
        // $("#error").innerText = "Fill inn all the detials"
        return;
      }
      $.ajax({
        url: 'php/login.php',
        type: 'post',
        data: data,
        success:function(response){
          console.log(response)
          alert(response);
          if(response == "Login Successful"){
            location.replace("profile.html");
            // window.location.reload();
          }
        }
      });
    });
  }
