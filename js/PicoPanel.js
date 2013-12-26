PicoPanel = new Object({
   addNotification: function (text, type) {
      $('#notification-area').append(" \
         <div class='alert alert-"+type+" fade in'>"+ text + " \
         <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> \
         </div>");
   }
});
