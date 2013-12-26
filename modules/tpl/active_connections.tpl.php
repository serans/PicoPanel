<div class="panel panel-default">
   <div class="panel-heading">Connections 
      <?php if($data['connections num_active'] > 0): ?>
         <span class="badge pull-right"><?php echo $data['connections num_active'] ?> active</span>
      <?php endif; ?>
   </div>

      <div class="list-group">
         <div class="list-group-item">
            <b>Host</b>
            <span class="pull-right"><b>Port(s)</b></span>
         </div>
          <?php foreach($data['connections'] as $host => $connection): ?>
          <div class="list-group-item" style="overflow:auto">
            <?php echo substr($host,-20)  ?>
            
            <?php if(isset($connection['TIME_WAIT'])): ?>
               <div class="pull-right" style="color:#aaa">
                  <?php if(isset($connection['ESTABLISHED'])): ?> 
                     <span style="color:#3a3">,&nbsp;</span>
                  <?php endif; ?>
                  <?php sort($connection['TIME_WAIT']); echo implode(', ',$connection['TIME_WAIT']); ?>
               </div>
            <?php endif; ?>
            
            
            <?php if(isset($connection['ESTABLISHED'])): ?>
               <div class="pull-right" style="color:#3a3"><?php sort($connection['ESTABLISHED']); echo implode(', ',$connection['ESTABLISHED']); ?></div>
            <?php endif; ?>
            
          </div>
          <?php endforeach; ?>
       </div>

</div>
