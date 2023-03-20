function submitData() {
  $(document).ready(function () {
    var data = {
      username: $("#username").val(),
      password: $("#password").val(),
    };
    // alert(data.)
    if (data.username === "" || data.password === "") {
      // alert(data)
      alert("Please fill in all the detials");
      // $("#error").innerText = "Fill inn all the detials"
      return;
    }
    $.ajax({
      url: "php/login.php",
      type: "post",
      data: data,
      success: function (response) {
        // alert(response.status);
        try{
          const parsed_response = JSON.parse(response);
          if (parsed_response.status == "success") {
            localStorage.setItem("user", JSON.stringify(parsed_response.data));
            alert(parsed_response.message);
            location.replace("profile.html");
          } else {
            alert(parsed_response.message);
          }
        }
        catch(err){
          alert(err)
        }
        
      },
    });
  });
}
