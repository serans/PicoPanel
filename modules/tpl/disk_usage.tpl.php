<div class="panel panel-default">
    <div class="panel-heading">Disk Usage</div>

    <div class="panel-body">
        <?php foreach($data as $disk): ?>
        <b><?php echo $disk['name'] ?></b>
        <div style="float:right"><?php echo $disk['free']." / ".$disk['total'] ?></div>
        <div class="progress">
          <div class="progress-bar" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $disk['usage'] ?>;">
            <span class="sr-only"><?php echo $disk['usage'] ?> Complete</span>
          </div>
        </div>
       <?php endforeach; ?>
    </div>
</div>
