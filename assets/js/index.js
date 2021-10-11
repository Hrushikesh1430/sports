function openForm() {
              
    document.getElementById("first").style.filter = "blur(8px)";
      document.getElementById("myForm").style.display = "block";

    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
      document.getElementById("first").style.filter = "none";
      document.getElementById("first").style.transition = "none";

    }
    
    window.onscroll = function() {myFunction()};

function myFunction() {
var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
var scrolled = (winScroll / height) * 100;
document.getElementById("myBar").style.width = scrolled + "%";
}

$(window).on('load', function(){
$(".loader-container").delay(1500).fadeOut(500);
});
