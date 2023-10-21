<?php
    //  include the navigation bar
    include_once('./topnav.php');
    include('../helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../index.php?error=error');
    }
    $applications = $db_helpers->getSpecifics('events' , $_SESSION['id']);
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/leaveApphis.css">
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
    <!-- <script type="text/javascript" src="./public/js/leaveApphis.js"></script> -->
    <style>    
        .expanded-row-content {
            display: grid;
            grid-column: 1/-1;
            justify-content: flex-start;
        }
        .hide-row {
            display: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: 6%;
        }
        tr {
        cursor: pointer;
        display: grid;
        grid-template-columns: repeat(auto-fill, 12%);
        }
    </style>
</head>
<div style="margin-top: 2%;margin-left:4%; font-size: 30px; color:white">
    <p class ="heading"> Application History</p>
</div>
<div style="margin-left: 4%; margin-right: 5%">

    <!-- Default display: pending -->
    <table>
        <tr >
            <th class= "theader">No</th>
            <th class= "theader">Application Date</th>
            <th class= "theader">Leave ID</th>
            <th class= "theader">Leave Type</th>
            <th class= "theader">Leave Days</th>
            <th class= "theader">Status</th>
            <th class= "theader"> Comment</th>
        </tr>

        <?php while ($application = mysqli_fetch_assoc($applications)): ?>
            <tr onClick="myFun(this)">
                <td> <?= $application['ID'] ?> </td>
                <td> <?= $application['appDate'] ?> </td>
                <td> <?= $application['lID'] ?> </td>
                <td> <?= $application['leaveType'] ?> </td>
                <td> <?= $application['duration'] ?> </td>
                <td> <?= $application['approvalstatus'] ? $application['approvalstatus'] : 'Pending' ?> </td>
                <td> <?= $application['reason']? $application['reason']: 'N/A' ?> </td>
                <td class="action"><button type="button" class="button"><img src="./public/images/verticalMore.png" alt="more"></button></td>
                <td class='expanded-row-content hide-row action'>
                    <div class="divMore" style="margin-left: 4%; margin-right: -2%;background-color: #015351; display:grid;padding: 20px;">
                        <div class="entry">
                            <label for="empId">Employee Id</label><br>
                            <input type="text" name="empId" value="<?= $application['ID'] ? $application['ID'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="leaveId">Leave Id</label><br>
                            <input type="text" name="leaveId" value="<?= $application['lID'] ? $application['lID'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="appDate">Application Date</label><br>
                            <input type="text" name="appDate" value="<?= $application['appDate'] ? $application['appDate'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="approvalStatus">Approval Status</label><br>
                            <input type="text" name="approvalStatus" value="<?= $application['approvalstatus'] ? $application['approvalstatus'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="approvalDate">Approval Date</label><br>
                            <input type="text" name="approvalDate" value="<?= $application['approvalDate'] ? $application['approvalDate'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="rejectionDate">Rejection Date</label><br>
                            <input type="text" name="rejectionDate" value="<?= $application['rejectionDate'] ? $application['rejectionDate'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="approvedBy">Approved By</label><br>
                            <input type="text" name="approvedBy" value="<?= $application['approvedBy'] ? $application['approvedBy'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="processedBy">Processed By</label><br>
                            <input type="text" name="processedBy" value="<?= $application['processedBy'] ? $application['processedBy'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="processingStatus">Processing Status</label><br>
                            <input type="text" name="processingStatus" value="<?= $application['processingStatus'] ? $application['processingStatus'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="numberOfDays">Number of Leave Days</label><br>
                            <input type="text" name="numberOfDays" value="<?= $application['duration'] ? $application['duration'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="leaveType">Leave Type</label><br>
                            <input type="text" name="leaveType" value="<?= $application['leaveType']  ? $application['leaveType'] : '' ?>" disabled>
                            </div>

                            <div class="entry">
                            <label for="comment">Comment</label><br>
                            <input type="text" name="comment" class="comment" value="<?= $application['reason'] ? $application['reason'] : '' ?>" disabled>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    
    

</div>

<script>
    
    document.getElementsByTagName.innerHTML = window.confirmationStyle();
    function confirmationStyle () {
        document.body.style.backgroundColor = "#FC9E01";
        document.getElementById("nav-title").textContent = "Leave Status";
        document.getElementById("nav-title").style.color = "#015351";
        document.getElementById("dd-content").style.backgroundColor = "#015351";
        document.getElementById("user_name").style.color = "#FC9E01";
        document.getElementById("navBtn").style.color = "#FC9E01";

    };
    function closeNav () {
        document.querySelector(".dd-content").style.display = "none";
    };

    function openNav () {
        document.querySelector("#dd-content").style.display = "block";
    };
    
    const myFun = (element) => {
      element.getElementsByClassName('expanded-row-content')[0].classList.toggle('hide-row');
      console.log(event);
    }

</script>
