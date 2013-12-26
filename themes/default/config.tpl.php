<?php global $modules ?>
<style>
   .notice {
      text-align: center;
      color: #aaa;
   }
</style>

<div class="row">
   <div class="col-md-3">
      <div class="panel panel-default">
      
         <div class="panel-heading">
            Inactive Modules
         </div>

         <div class="list-group connectedSortable" id="modules-list" >
         <?php foreach($modules as $module): ?>
            <div class="list-group-item" href="#">
               <input type="hidden" name="className[]" value="<?php echo $module ?>">
               <?php echo $module::getInfo()['name']; ?>
               <?php if( !empty($module::$config) ): ?>
                  <a class="badge" href="#"><span class="glyphicon glyphicon-cog"></span></a>
               <?php endif; ?>
            </div>
         <?php endforeach; ?>
         </div>
      </div>
   </div>
   <div class="col-md-9 panel">
      <div class="row" style="background:#efe; padding-top:10px;">
         <h4 style="margin-left:20px">Layout</h4>
         <div class="col-sm-4">
            <div class="panel panel-default panel-plain">
               <div class="panel-heading">Left Column</div>
               <div id="col-left" class="connectedSortable list-group">
               </div>
            </div>
         </div>
         
         <div class="col-sm-4">
            <div class="panel panel-default  panel-plain">
               <div class="panel-heading">Centre Column</div>
               <div id="col-centre" class="connectedSortable list-group">
               </div>
            </div>
         </div>
         
         <div class="col-sm-4">
            <div class="panel panel-default  panel-plain">
               <div class="panel-heading">Right Column</div>
               <div id="col-right" class="connectedSortable list-group">
               </div>
            </div>
         </div>
         
      </div>
      
      <div class="row" style="background:#efe; padding:20px;">
         <button id="restore-button" type="button" class="btn btn-lg disabled" onClick="applyConfig(original_config)">
            <span id="restore-button-glyph" class="glyphicon glyphicon-backward"></span>
            Restore
         </button>
         
         <button id="save-button" type="button" class="btn btn-lg btn-danger disabled pull-right" onClick="saveConfig()">
            <span id="save-button-glyph" class="glyphicon glyphicon-floppy-saved"></span>
            Save
         </button> 
         
      </div>
      
   </div>
</div>


<script>

var original_config = JSON.parse(<?php echo json_encode(file_get_contents($root_dir.'config.json')) ?>)

function getConfig(json) {
   config = new Object();
   ["left","centre","right"].forEach( function(div) {
      modules = [];
      $("#col-"+div+" input").each(function() {
         modules.push($(this).val());
      });
      config[div]=modules;
   });
   
   if(json==true)
      return JSON.stringify({"layout":config});
   else
      return config;
}

function saveConfig() {
   $.ajax({
      type: "POST",
      url: "?section=config",
      data: "save_config="+getConfig(true),
      success: function(r) {
         if(r=='OK')
            PicoPanel.addNotification("Configuration Saved","success")
         else
            PicoPanel.addNotification("There was an error processing the request and the configuration could NOT be saved","danger")
      },
      error: function() {PicoPanel.addNotification("There was an error processing the request and the configuration could NOT be saved","danger")},
   });
   
   disableSave();
   
}

function enableSave() {
   $("#save-button").removeClass('disabled');
   $("#save-button-glyph").removeClass('glyphicon-floppy-saved').addClass('glyphicon-floppy-save');
   $("#restore-button").removeClass('disabled');
   toggleNotices();
}

function disableSave() {
   $("#save-button").addClass('disabled'); 
   $("#save-button-glyph").removeClass('glyphicon-floppy-save').addClass('glyphicon-floppy-saved');
   $("#restore-button").addClass('disabled'); 
   toggleNotices();
}

function applyConfig(config) {
   config.layout.left.forEach( function (module) { moveModule(module, 'col-left') } );
   config.layout.centre.forEach( function (module) { moveModule(module, 'col-centre') } );
   config.layout.right.forEach( function (module) { moveModule(module, 'col-right') } );

   disableSave();
}


function moveModule(module,destination) {
   div = $('input[value="'+module+'"]').parent();
   $('#'+destination).append(div);
   toggleNotices();
}

function toggleNotices() {
   $('.connectedSortable').find('.notice').remove()

   $('.connectedSortable').each( function(){
      if( $(this).children().size()==0 ) {
         $(this).append('<div class="list-group-item notice">Drag and drop modules here</div>');
      }
   });
}

$(function() {
   selector = $( "#col-left, #col-centre, #col-right, #modules-list" ).sortable({
      connectWith: ".connectedSortable",
      stop: function(u,i) { enableSave() },
   });
   
   applyConfig(original_config);
});

</script>
