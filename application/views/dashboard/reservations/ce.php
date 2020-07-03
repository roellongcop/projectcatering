<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recto's Catering</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url() . 'resources/css/dashboard.css'; ?>">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
    </header>

        <div class="content-wrapper">
            <div class="row" style="width: 500px; min-height: 400px; margin-left: 10px;">

                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 5px;text-align: left;">
                            <h5 style="color: #d35400;font-size: 20px;font-weight: bold;margin-top: 5px;margin-bottom: 5px;">RECTO's CATERING</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-top: 15px;text-align: center;">
                            <p style="font-size: 16px;">Your reservation <span style="font-weight: bolder;color: #d35400;font-size: 18px;"><?= $reservation['reservation_code']; ?></span> is </p>
                            <?php if ($reservation['status'] == 'confirmed'): ?>
                                <h4 style="font-size: 34px; color: #009432;background: #EAFFF3;padding: 10px;font-weight: bold;"><?= strtoupper($reservation['status']); ?></h4>
                                <h5 style="font-size: 18px;">Event date: <?= date_format(date_create($reservation['date_of_event']), 'F d, Y'); ?></h5>
                            <?php else: ?>
                                <h4 style="font-size: 34px; color: #e74c3c;background: #FFEDEB;padding: 10px;font-weight: bold; "><?= strtoupper($reservation['status']); ?></h4>
                                <h5 style="font-size: 16px;">Reason: <?= $reservation['reject_reason']; ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div style="padding-left: 10px;padding-top: 10px;color: #2c3e50;font-weight: bold;font-size: 15px;">
                            <span style="font-weight: normal;">Package: </span><span> <?= $reservation['package_name']; ?></span><br>
                            <span style="font-weight: normal;">Customer Name: </span> <span><?= $reservation['customer_name']; ?></span><br>
                            <span style="font-weight: normal;">Customer No.: </span><span> <?= $reservation['customer_contact']; ?></span><br>
                            <span style="font-weight: normal;">Email: </span><span> <?= $reservation['customer_email']; ?></span><br>
                            <br>
                        </div>
                    </div>
                </div>

                <?php if ($reservation['status'] == 'confirmed'): ?>
                <div class="row">
                    <div class="col-md-12">
                        <p style=" font-weight: bolder; color: #d35400; text-align: center; text-transform: uppercase; font-size: 18px; background: #FFF5ED; padding: 10px;">Package Amount: PHP <?= number_format($reservation['total_amount'], 2); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($reservation['status'] == 'confirmed'): ?>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h5>Thank you for choosing us! See you on the event!</h5>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </body>
</html>




