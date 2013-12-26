<div class="panel panel-default">
   <div class="panel-heading">CPU usage</div>
   
   <div class="panel-body">
      <table class="table table-condensed table-striped">
          <thead>
            <tr>
              <th>process</th>
              <th>%cpu</th>
              <th>%mem</th>
            </tr>
          </thead>
         <?php foreach($data as $item): ?>
            <?php if($item[1]!='0.0'): ?>
             <tr>
               <td><?php echo ($item[0]); ?></td>
               <td><?php echo ($item[1]); ?></td>
               <td><?php echo ($item[2]); ?></td>
             </tr>
            <?php endif; ?>
          <?php endforeach; ?>
      </table>
   </div>
</div>
