function verifyPass() 
{
    var p1 = document.getElementById("inputPassword").value;
    var p2 = document.getElementById("inputVerifyPassword").value;

    if (p1 != p2) {
        alert("Las passwords deben de coincidir");
        return false;
      } 
      else 
      {
        alert("Todo esta correcto");
        return true; 
      }
}