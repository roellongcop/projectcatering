<?= $header; ?>
<div style="height: 80px;"></div>
<?php foreach ($event_packages as $key => $val): ?>
<div class="parallax-container" style="height: 800px!important;">
    <div class="parallax"><img src="<?= base_url(). $val['event_details']['event_image']['current_path']; ?>" style="filter: blur(5px);"></div>
    
    <div class="package-area">
        <h4><?= $val['event_details']['event_name']; ?></h4>
        <p><?= $val['event_details']['description']; ?></p>

        <div class="row" style="height: 355px; overflow-y: auto; margin-bottom: 0px!important;">
            <?php foreach ($val['packages'] as $vKey => $package): ?>
            <div class="col s12 m4 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="<?= base_url() . $package['image']['current_path']; ?>">
                        <span class="card-title package-title"><?= $package['name']; ?></span>
                    </div>
                    <div class="card-content package-content">
                        <div class="row">
                            <div class="col s12">
                                <h5 class="center" style="margin-top: 0px; color: #e67e22;">PHP <?= number_format($package['price'], 2); ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 center">
                                <a href="<?= base_url(). 'site/package/'.$package['id']; ?>" class="view-package-info">MORE INFORMATION</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="package-area-build btnBuild" data-id="<?= $val['event_details']['event_id']; ?>">                    
                <div class="col s3 m3" style="text-align: center;">
                    <div class="icon">
                        <i class="ion ion-spoon big-icon"></i> <i class="ion ion-fork big-icon"></i>
                    </div>
                </div>
                <div class="col s9 m9">
                    <h5 class="btnBuild" data-id="<?= $val['event_details']['event_id']; ?>">CUSTOMIZE PACKAGE</h5>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php endforeach; ?>

<?= $footer; ?>