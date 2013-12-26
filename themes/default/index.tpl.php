<div class="row">
   <div id="col-remove" class="col-md-12 connectedSortable">
      <div class="alert alert-danger" style="text-align:center">
         Drag and drop a module here to disable it.
      </div>
   </div>
</div>

<div class="row">
   <div class="col-md-4 connectedSortable" id="col-left">
      <?php foreach ( $config->layout->left as $module ) $module::render(); ?>
   </div>

   <div class="col-md-4 connectedSortable" id="col-centre">
      <?php foreach ( $config->layout->centre as $module ) $module::render(); ?>
   </div>

   <div class="col-md-4 connectedSortable" id="col-right">
      <?php foreach ( $config->layout->right as $module ) $module::render(); ?>
   </div>
</div>
<script>
$(function() {
   var removeIntent = false;

   $('#col-remove').hide();
/*

   selector = $( "#col-left, #col-centre, #col-right" ).sortable({
      handle: ".panel-heading",
      connectWith: ".connectedSortable",
      over: function () {
          removeIntent = false;
      },
      out: function () {
          removeIntent = true;
      },
      beforeStop: function (event, ui) {
          if(removeIntent == true){
              ui.item.remove();   
          }
      },
      start: function() { 
         $("#col-remove").show();
      },
      stop: function(u,i) { 
         $("#col-remove").hide();
      },

   });
*/
});
</script>
