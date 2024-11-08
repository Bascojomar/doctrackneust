<div class="modal fade" id="ModalDetails<?php echo $row['docu_id']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">[<?php echo $row['documentSubject']; ?>] Details</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be populated dynamically -->
                    <p id="modalContent"></p>


                    <style>
                        .info-card {
                            display: flex;
                            flex-direction: column;
                            border: 1px solid #dee2e6;
                            margin-bottom: 1rem;
                            margin-left: 0.7rem;
                            width: 98.2%;
                            max-width: 97%;
                            background-color: #dee2e6;
                            border-radius: 5px;

                        }

                        .info-card p {
                            color: #343a40;
                        }

                        .info-card p {
                            color: #6c757d;
                        }

                        .info-card i {
                            color: black;
                            margin-right: 0.5rem;
                        }

                        .table-div {
                            display: flex;
                            flex-direction: column;
                            border: 1px solid #dee2e6;
                        }

                        .table-header,
                        .table-row {
                            display: flex;
                            width: 100%;
                        }

                        .table-cell {
                            padding: 0.75rem;
                            border: 1px solid #dee2e6;
                            flex: 1;
                        }

                        .table-header {
                            background-color: #f8f9fa;
                            font-weight: bold;
                        }
                    </style>


                    <?php



                    echo '<div class="form-group">

                        <div class="row">
                            <div class="col-12 info-card">
                            <span style="font-weight:bold;"> REFERENCE NO: </span>
                                <p style="color:black;">' . $row['referenceNo'] . '</p>
                            </div>
                            <div class="col-12 info-card">
                            <span style="font-weight:bold;"> TITLE: </span>
                                <p style="color:black;">' . $row['documentSubject'] . '</p>
                            </div>
                            <div class="col-12 info-card">
                            <span style="font-weight:bold;"> USER CREATED: </span>
                                <p style="color:black;">' . $row['userCreated'] . '</p>
                            </div>';
                    $sqla = "SELECT * FROM documentvoucher where referenceNo ='$referenceNo'  ";
                    $resulta = mysqli_query($conn, $sqla);

                    if (mysqli_num_rows($resulta) > 0) {
                        // Output data of each row
                        while ($rowa = mysqli_fetch_assoc($resulta)) {

                            echo '
                            <div class="col-12 info-card">
                                <p>Document Type: ' . $rowa['vType'] . '</p>
                            </div>';
                        }
                    }
                    echo '
                            <div class="col-12 info-card">
                            <span style="font-weight:bold;"> OFFICE CREATED: </span>
                                <p style="color:black;">Head Office</p>
                            </div>
                        </div>';





                    $is_voucher = $row['is_voucher'];
                    $referenceNo = $row['referenceNo'];

                    if ($is_voucher == 1) {
                        echo '<div class="table-title">Voucher Information </div>';
                        echo '<div class="table-header">
            <div class="table-cell">Voucher Type</div>
            <div class="table-cell">Voucher Number</div>
            <div class="table-cell">Voucher Ammount</div>
            <div class="table-cell">Date Created</div>
        </div>';
                        $sqla = "SELECT * FROM documentvoucher where referenceNo ='$referenceNo'  ";
                        $resulta = mysqli_query($conn, $sqla);

                        if (mysqli_num_rows($resulta) > 0) {
                            // Output data of each row
                            while ($rowa = mysqli_fetch_assoc($resulta)) {
                                echo '
                    <div class="table-row">
                        <div class="table-cell">' . getVoucherType($rowa['vType']) . '</div>
                        <div class="table-cell">' . $rowa['Vnumber'] . '</div>
                        <div class="table-cell">' . $rowa['vAmmount'] . '</div>
                        <div class="table-cell">' . $rowa['dateCreated'] . '</div>
                   
                    </div> ';
                            }
                        }
                    }

                    ?>
                    <div class="table-title">Signatory Information </div>
                    <div class="table-header">
                        <div class="table-cell">Office(s)</div>
                        <div class="table-cell">Date Recieved</div>
                        <div class="table-cell">Date Signed</div>
                        <div class="table-cell">Date Released</div>
                        <div class="table-cell">Status</div>
                        <div class="table-cell">Remarks</div>
                    </div>
                    <!-- <div class="table-row">
                            <div class="table-cell">Sample </div>
                            <div class="table-cell">Sample </div>
                            <div class="table-cell">Sample </div>
                            <div class="table-cell">Sample </div>
                            <div class="table-cell">Sample </div>
                            <div class="table-cell">Sample </div>
                        </div> -->

                    <?php
                    $referenceNo = $row['referenceNo'];
                    $sqla = "SELECT * FROM documentdetails where referenceNo ='$referenceNo'  ";
                    $resulta = mysqli_query($conn, $sqla);

                    if (mysqli_num_rows($resulta) > 0) {
                        // Output data of each row
                        while ($rowa = mysqli_fetch_assoc($resulta)) {

                            echo '
                 <div class="table-row">
                            <div class="table-cell">' . GetOffice_ID($rowa['office_tag']) . ' </div>
                            <div class="table-cell">' . $rowa['dateRecieved'] . ' </div>
                            <div class="table-cell">' . $rowa['dateSigned'] . ' </div>
                            <div class="table-cell">' . date("M d, Y", strtotime($rowa['dateRelease'])) . ' </div>
                            <div class="table-cell">' . $rowa['status'] . ' </div>
                            <div class="table-cell">' . $rowa['remarks'] . ' </div>
                        </div>
                                 ';
                        }
                    }





                    ?>


                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="removeUser" value="removeUser">Yes</button>
            </div>
    </div>
    </form>
</div>
</div>


<div class="modal fade" id="sendTomodal<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campusModalLabel">Send to

                    <?php $campus = GetCampusid($row['officeCreated']);
                    if ($campus == 1 || $campus == 2) {
                        echo "Main Records";
                    } else {
                        echo "Campus Records";
                    }


                    ?> </h5>



                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="officeCode" class="form-label">Do you want to send this Document?</label>
                        <input type="text" class="form-control" id="officeCode" name="id" value="<?php echo $row['docu_id']; ?>" hidden required>
                        <input type="text" class="form-control" id="officeCode" name="campusGet" value="<?php echo GetCampusid($row['officeCreated']) ?>" hidden>
                    </div>
                    <div class="modal-footer">

                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>  -->


                        <?php $campus = GetCampusid($row['officeCreated']);
                        if ($campus == 1 || $campus == 2) {
                            echo '                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" name="sendTomain" value="sendTo">Send To Main Record</button>
                            </div>';
                        } else {
                            echo '                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" name="sendTo" value="sendTo">Send To Campus Record</button>
</div>
</div>';
                        }


                        ?>


                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addoffice<?php echo $row['attachmentID']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="attachmentReferenceNo" name="attachmentReferenceNo" value="<?php echo htmlspecialchars($row['attachmentReferenceNo']); ?>" hidden>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['attachmentID']; ?>" hidden>
                        <label for="subject" class="form-label">Add Office</label>

                        <?php
                        $query = "SELECT * FROM offices ORDER BY office_id";
                        $results = $conn->query($query);

                        while ($rows = $results->fetch_assoc()) {
                            echo '<div class="checkbox-wrapper">
                                        <input type="checkbox" id="office_' . $rows["office_id"] . '" name="offices[]" value="' . $rows["office_id"] . '">
                                        <label for="office_' . $rows["office_id"] . '">' . $rows["officeName"] . '</label>
                                    </div>';
                        }
                        ?>


                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addoffice" value="editCampus">Edit Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="sendTomain<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campusModalLabel">Send to Main Record
                </h5>



                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="officeCode" class="form-label">Do you want to send this Document?</label>
                        <input type="text" class="form-control" id="officeCode" name="id" value="<?php echo $row['docu_id']; ?>" required hidden>
                        <input type="text" class="form-control" id="officeCode" name="campusGet" value="<?php echo GetCampusid($row['officeCreated']) ?>" hidden>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" name="sendTomain" value="sendTomain">Send To main</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendTosignatory<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campusModalLabel">Send to Signatory
                </h5>



                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="officeCode" class="form-label">Do you want to send this Document?</label>
                        <input type="text" class="form-control" id="referenceNo" name="referenceNo" value="<?php echo $row['referenceNo']; ?>" hidden>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" name="sendTosign" value="sendTosign">Send To</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="docuEdit<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['docu_id']; ?>" hidden>
                        <label for="subject" class="form-label">Title :</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['documentSubject']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Reupload :</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editsub" value="editCampus">Edit Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="officeEdit<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['docu_id']; ?>" hidden>
                        <label for="subject" class="form-label">Title :</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['documentSubject']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Reupload :</label>
                        <?php
                        $file_dir = '../pdf/' . $row['fileUpload'];
                        echo '
                             <span  id="mylink" onclick="openCustom(\'' .
                            $file_dir . '?' . time() . '\',1000,1000)" class="btn button-s btn-sm">' . $row['documentSubject'] . '</span>
                             ';
                        ?>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="office" value="editCampus">Edit Campus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalreleased<?php echo htmlspecialchars($row['dd_id']); ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="ref" name="reference" value="<?php echo htmlspecialchars($row['referenceNo']); ?>" hidden>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['dd_id']); ?>" hidden>
                    <label for="statusSelect<?php echo htmlspecialchars($row['dd_id']); ?>">Status :</label>
                    <select name="status" id="statusSelec<?php echo htmlspecialchars($row['dd_id']); ?>" class="form-control">

                    </select>
                    <?php $date = date('Y-m-d'); ?>
                    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="released" value="released">Release</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalsigned<?php echo htmlspecialchars($row['dd_id']); ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['dd_id']); ?>" hidden>
                    <input type="text" class="form-control" id="referenceNo" name="referenceNo" value="<?php echo $row['referenceNo']; ?>" hidden>
                    <label for="statusSelect<?php echo htmlspecialchars($row['dd_id']); ?>">Status :</label>
                    <select name="status" id="statusSelect<?php echo htmlspecialchars($row['dd_id']); ?>" class="form-control" required>
                        <option value="" hidden>Status</option>
                    </select>
                    <div class="form-group rejectInput">
                        <label for="rejectInput<?php echo htmlspecialchars($row['dd_id']); ?>">Remarks :</label>
                        <input type="text" id="rejectInput<?php echo htmlspecialchars($row['dd_id']); ?>" name="remarks" class="form-control">
                    </div>
                    <?php $date = date('Y-m-d'); ?>
                    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="signed" value="Signed">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="reupload<?php echo htmlspecialchars($row['docu_id']); ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['docu_id']); ?>" hidden>

                    <div class="form-group rejectInput">
                        <label for="rejectInput">Reupload :</label>
                        <input type="file" id="file" name="file" class="form-control" accept='application/pdf' required>
                    </div>
                    <?php $date = date('Y-m-d'); ?>
                    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="reupload" value="Reupload">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="recieveby<?php echo htmlspecialchars($row['docu_id']); ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="campusModalLabel">Edit Details</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['docu_id']); ?>" hidden>

                    <div class="form-group rejectInput">
                        <label for="rejectInput">Received by :</label>
                        <input type="text" id="received" name="received" class="form-control" required>
                    </div>
                    <label for="rejectInput">Contact :</label>
                    <input type="number" id="contact" name="contact" class="form-control" required>
            </div>
            <?php $date = date('Y-m-d'); ?>
            <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" hidden>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="receivedby" value="receivedby">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="doneDetails<?php echo $row['docu_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campusModalLabel">
                    <?php echo $row['documentSubject']; ?>
                </h5>



                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backEnd/newdocuAuth.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">

                        <div class="modal-content">
                            <h2>Reference Number</h2>
                            <p><strong>Name:</strong> <span id="name"><?php echo $row['documentCode']; ?></span></p>
                            <p><strong>Contact Number:</strong> <span id="contactNumber"><?php echo $row['contactNo']; ?></span></p>
                            <p><strong>Date Received:</strong> <span id="dateReceived"><?php echo $row['dateRecievedby']; ?></span></p>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Include your custom JavaScript -->
<script src="path/to/your/modal.js"></script>