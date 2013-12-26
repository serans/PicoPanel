<style>

#file_explorer_go {
   float: right;
   position: absolute;
   right: 1.3em;
}

form {
  margin:0;
}

#file_explorer_go button {
   top:0;
   line-height: 1.42857;
}
</style>

<div class="panel panel-default">

   <div class="panel-heading">File Explorer</div>

   <div class="panel-body" style="padding: 3px; background: rgb(238, 238, 238);">
      <form id="file_explorer_form" action="javascript:" onSubmit="fileExplorer.loadFolder($('#file_explorer_url').val())">
         <div id="file_explorer_go" >
           <button class="btn btn-default" onClick="">Go</button>
         </div>
         <input class="form-control" type="text" id="file_explorer_url" />
      </form>
   </div>
   
   <div class="list-group" id="folders-list"></div>
   
</div>

<script>
   fileExplorer = new Object()

   fileExplorer.displayData = function (json_data) {
      $('#folders-list').children().remove();
   
      folders = json_data.folders;
      files = json_data.files;
   
      folders.forEach( function(folder) {
         if(fileExplorer.basename(folder)=='.') {
           $('#file_explorer_url').val(fileExplorer.dirname(folder))
         } else {
           $('#folders-list').append(" \
           <a class='list-group-item'  href='javascript:fileExplorer.loadFolder(\""+folder+"\")' > \
           <span class='glyphicon glyphicon-folder-open'></span>&nbsp;  \
           "+fileExplorer.basename(folder)+"</a> ")
         }
      });
      
      files.forEach( function(file) {
         $('#folders-list').append(" \
           <a class='list-group-item'  href='javascript:fileExplorer.loadFile(\""+file+"\")' > \
           <span class='glyphicon glyphicon-file'></span>&nbsp;  \
           "+fileExplorer.basename(file)+"</a> ")
      });
    }  

   fileExplorer.basename = function (path, suffix) {
      var b = path.replace(/^.*[\/\\]/g, '');
      if (typeof suffix === 'string' && b.substr(b.length - suffix.length) == suffix) {
         b = b.substr(0, b.length - suffix.length);
      }
      return b;
   }
   
   fileExplorer.dirname = function (path) {
      return path.substring( 0, path.lastIndexOf( "/" ) + 1);
   }
   
   fileExplorer.loadFolder = function (folder) {
      $.ajax({
         type: 'GET',
         url: '?m=FileExplorer&p={"action":"loadFolder","url":"'+folder+'"}',
         success: function(r) {
            fileExplorer.displayData(JSON.parse(r));
         },
         error: function() {
            PicoPanel.addNotification("File Explorer could not retrieve folder","danger")
         },
      });
   }
   
   fileExplorer.loadFile = function (file) {
      window.location = '?m=FileExplorer&p={"action":"loadFile","url":"'+file+'"}'
   }

   json_data = JSON.parse('<?php echo json_encode($data) ?>');
   fileExplorer.displayData(json_data);

</script>
