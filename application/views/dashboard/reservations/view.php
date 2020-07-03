<?= $admin_header; ?>
<section class="content-header">
    <h1>
    Reservations
    <small>| Reservation Details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Reservations</a></li>
        <li class="active">Reservation Details</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Reservation No. <?= $reservation['id']; ?></h3>
                </div>
                <div class="box-body" style="padding-bottom: 30px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="rescode-display">
                                <small>RESERVATION CODE:</small>
                                <h5><?= $reservation['reservation_code']; ?></h5>
                                <?php if ($reservation['cancelled_flag'] == 1): ?>
                                <div class="request-for-cancel">
                                    <span>Requested for cancellation by: <?= $reservation['cancellation_details']['cancelled_by']; ?> on <?= date_format(date_create($reservation['cancellation_details']['date']), 'F j, Y'); ?></span>
                                    <br>
                                    <span>Reason: <?= $reservation['cancellation_details']['reason']; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 pull-right" style="padding-right: 30px;">
                            <div class="view-status">
                                <small>RESERVATION STATUS:</small>
                                <h5 class="<?= $reservation['status']; ?>"><?= ucfirst($reservation['status']); ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php if ($reservation['status'] == 'rejected'): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cancel-reason">
                                <label style="color: #e74c3c;">REASON FOR REJECTION</label>
                                <p style="margin-left: 10px;"><?= $reservation['reject_reason']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="res-details">
                                <h5>Reservation Information</h5>
                                <div class="row">
                                    <div class="col-md-5" style="padding-left: 25px;">
                                        <span>Date & Time of Event:</span><br>
                                        <span>Package Chosen:</span><br>
                                        <span>Theme: </span><br>
                                        <span>Total Amount:</span><br>
                                    </div>
                                    <div class="col-md-7">
                                        <span><?= date_format(date_create($reservation['date_of_event']), 'F d, Y'); ?> ( <?= isset($reservation['event_time']) ? $reservation['event_time']: 'N/A'; ?> )</span><br>
                                        <span><?= $reservation['package_name'] == null ? 'Custom Package' : $reservation['package_name']; ?></span><br>
                                        <span><?= $reservation['theme_name'] == null ? '<span class="theme-link" data-toggle="modal" data-target="#themeModal">Custom Theme</span>' : $reservation['theme_name']; ?></span><br>
                                        <span>PHP <?= number_format($reservation['total_amount'], 2); ?></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="customer-details">
                                <h5>Customer Information</h5>
                                <div class="row">
                                    <div class="col-md-5" style="padding-left: 25px;">
                                        <span>Customer Name:</span><br>
                                        <span>Customer Email:</span><br>
                                        <span>Contact No.:</span><br>
                                        <span>Complete Address:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <span><?= $reservation['customer_name']; ?></span><br>
                                        <span><?= $reservation['customer_email']; ?></span><br>
                                        <span><?= $reservation['customer_contact']; ?></span><br>
                                        <span><?= $reservation['customer_address']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="other-details">
                                <h5>Other Information</h5>
                                <div class="row">
                                    <div class="col-md-5" style="padding-left: 25px;">
                                        <span>Valid Document Proof: </span><br>
                                        <?php if (($reservation['venue_id'] !== '0' && ! is_null($reservation['venue_name'])) || $reservation['custom_venue'] !== null): ?>
                                        <span>Event Venue: </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-5">
                                        <span data-toggle="modal" data-target="#documentModal" style="color: #3498db; cursor: pointer; text-decoration: underline;">VIEW VALID DOCUMENT</span><br>
                                        <?php if (($reservation['venue_id'] !== '0' && ! is_null($reservation['venue_name'])) || $reservation['custom_venue'] !== null): ?>
                                        <span data-toggle="modal" data-target="#venueModal" style="color: #3498db; cursor: pointer; text-decoration: underline;">VIEW DETAILS</span><br>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="package-items">
                                <h5 style="color: #e67e22;">FOODS</h5>
                                <table id="packageFoodsTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>FOOD NAME</th>
                                            <th>QUANTITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservation['foods'] as $val): ?>
                                        <tr>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= $val['quantity'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="package-items">
                                <h5 style="color: #e67e22;">ITEMS </h5>
                                <table id="packageItemsTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ITEM NAME</th>
                                            <th>QUANTITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservation['package_items'] as $val): ?>
                                        <tr>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= $val['quantity'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if (! $is_date_passed): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="res-controls">
                                <div class="row">
                                    <?php if (! $reservation['cancelled_flag'] == 1 && $reservation['status'] == 'pending'): ?>
                                    <div class="col-md-6">
                                        <div class="btnConfirmReservation" data-id="<?= $reservation['id']; ?>">
                                            <h5><i class="fa fa-check" aria-hidden="true"></i> CONFIRM RESERVATION</h5>
                                        </div>
                                    </div>
                                    <?php if ($reservation['status'] !== 'rejected'): ?>
                                    <div class="col-md-6">
                                        <div class="btnShowCancelReason">
                                            <h5>REJECT RESERVATION <i class="fa fa-times" aria-hidden="true"></i></h5>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if ($reservation['status'] !== 'rejected'): ?>
                                    <div class="col-md-6">
                                        <div class="btnShowCancelReason">
                                            <h5>CANCEL RESERVATION<i class="fa fa-times" aria-hidden="true"></i></h5>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="rejectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark this reservation as rejected ? </p>
                <br>
                <label>Please provide reason for rejection to inform the client</label>
                <input type="hidden" id="res_id" />
                <?php if ($reservation['cancelled_flag'] == 1): ?>
                <textarea id="reject_cancel_reason" class="form-control" rows="5"><?= $reservation['cancellation_details']['reason']; ?></textarea>
                <?php else: ?>
                <textarea id="reject_cancel_reason" class="form-control" rows="5"></textarea>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btnRejectReservation" data-id="<?= $reservation['id']; ?>">Reject</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="sameDateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                <p>There are other reservations with the same date and confirming this will result in rejecting those.</p>
                <p>Are you sure you want to proceed? </p>
                <br>
                <label>Please provide reason for rejection to inform the clients</label>
                <input type="hidden" id="same_ids" />
                <input type="hidden" id="res_id" />
                <textarea id="cancel_reason" class="form-control" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnFinalConfirmation">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="documentModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Valid Document Proof</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?= base_url() . $reservation['valid_document']['current_path']; ?>" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="themeModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Theme provided by client</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p><?= $reservation['theme_desc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="venueModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Venue</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($reservation['venue_id'] === '0'): ?>
                        <h5>Venue Description</h5>
                        <p><?= $reservation['custom_venue']; ?>
                            <?php else: ?>
                            <h5 style="text-align: center;font-size: 24px;"><?= $reservation['venue_name']; ?></h5>
                            <img src="<?= base_url() . $reservation['venue_image']['current_path']; ?>" style="width: 70%; display: block;margin: 0 auto;">
                            <p style="font-size: 16px; text-align: center; margin-top: 20px;"><?= $reservation['venue_desc']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="updateModalLoading" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align: center; font-size: 20px;">Processing Reservation...</p>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to cancel this reservation? Please provide your reason.</h5>
                    <textarea class="form-control" id="cancelReason" rows="5"></textarea>
                    <span class="cancelReasonError hide" style="color: red;">Please provide the reason for cancellation.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnCancelReservation" data-id="<?= $reservation['id']; ?>">CONTINUE</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <?= $admin_footer; ?>