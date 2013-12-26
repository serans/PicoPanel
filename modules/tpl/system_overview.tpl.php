<div class="panel panel-default">
    <div class="panel-heading">System</div>
    <div class="panel-body">
        <b>Uptime</b>
        <p><?php echo $data['uptime'] ['days']." days ".$data['uptime'] ['h']."h ".$data['uptime'] ['m']."'".$data['uptime'] ['s']."''" ?> </p>

        <b>IP</b>
        <p><?php echo $data['ip'] ?></p>

        <b>Processess running</b>
        <p><?php echo $data['proc num']  ?></p>

        <b>Memory</b>
        <?php 
         $per_used = ($data['memory']['used']/$data['memory']['total'])*100;
         $per_cache = ($data['memory']['swap/cache']/$data['memory']['total'])*100;
        ?>
        <div style="float:right"><?php echo $data['memory']['used'] ?>M / <?php echo $data['memory']['total'] ?>M</div>
        <div class="progress progress-mem-total">
          <div class="progress-bar progress-mem-used" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $per_used ?>%;">
            <span class="sr-only"><?php echo $data['memory']['used'] ?> Complete</span>
          </div>
          <div class="progress-bar progress-mem-swap" style="width: <?php echo $per_cache ?>%">
             <span class="sr-only"><?php echo $data['memory']['swap/cache'] ?></span>
          </div>
        </div>
    </div>
</div>

