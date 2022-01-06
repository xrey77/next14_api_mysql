$(document).ready(function() {
    preventBack = () => {
        window.history.forward();
      }
      setTimeout("preventBack()", 0);
      window.onunload = function () { null };
      
      window.history.pushState(null, "", window.location.href);
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };

    $('#messageModal').modal('show');
    $("#messageModal").on("hidden.bs.modal", function () {
        location.href="/";
        return;
    });
});