<?php
session_start();

include 'db_conntect.php';

if (!empty($_GET['id'])) {
    $noteid = $_GET['id'];
    $attaarray = array();
    $i = 0;
    $updatetask = 0;
    $attanamearray = array();
    $getdetail = "SELECT * FROM sellernotes WHERE ID = $noteid";
    $query = mysqli_query($conn, $getdetail);
    if ($query) {
        $detail = mysqli_fetch_assoc($query);
        $sellerid = $detail['SellerID'];
        $buyerid = $_SESSION['user_id'];
        $ispaid = $detail['IsPaid'];
        $price = $detail['SellingPrice'];
        $title = $detail['Title'];
        $category = $detail['Category'];

        $getcategory = "SELECT * FROM notecategories WHERE ID = '$category' AND IsActive = b'1'";
        $catquery = mysqli_query($conn, $getcategory);
        $catdeatil = mysqli_fetch_assoc($catquery);
        $catname = $catdeatil['Name'];

        $getatta = "SELECT * FROM sellernotesattachements WHERE NoteID = $noteid";
        $attachements = mysqli_query($conn, $getatta);
        if ($attachements) {
            $count = mysqli_num_rows($attachements);

            $getid = "SELECT * FROM downloads WHERE NoteID = $noteid AND Downloader = $buyerid";
            $getidquery = mysqli_query($conn, $getid);
            $iddata = mysqli_fetch_assoc($getidquery);
            $idcount = $iddata['ID'];

            while ($atta = mysqli_fetch_assoc($attachements)) {
                $fpath = $atta['FilePath'];
                if (file_exists($fpath)) {
                    array_push($attaarray, $atta['FilePath']);
                    array_push($attanamearray, $atta['FileName']);
                } else {
                    echo "file not found";
                }

                if ($ispaid == 0) {
                    $insertdata1 = "INSERT INTO `downloads` (`NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AtachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$noteid', '$sellerid', '$buyerid', b'1', '$fpath', b'1', current_timestamp(), b'0', NULL, '$title', '$catname', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
                    $query1 = mysqli_query($conn, $insertdata1);
                    if (!($query1)) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                } else {
                    $checkquery = "SELECT * FROM downloads WHERE NoteID = $noteid AND Downloader = $buyerid";
                    $check = mysqli_query($conn, $checkquery);
                    $checkdata = mysqli_fetch_assoc($check);

                    $isdownloaded = $checkdata['IsAttachmentDownloaded'];
                    if ($isdownloaded == 1 && $updatetask == 0) {
                        $insertdata2 = "INSERT INTO `downloads` (`NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AtachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$noteid', '$sellerid', '$buyerid', b'1', '$fpath', b'1', current_timestamp(), b'1', '$price', '$title', '$catname', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
                        $query2 = mysqli_query($conn, $insertdata2);
                        if (!($query2)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                    } else {
                        $updatedata = "UPDATE `downloads` SET `IsAttachmentDownloaded` = b'1', `AttachmentDownloadedDate` = current_timestamp() WHERE NoteID = '$noteid' AND Downloader = '$buyerid' AND ID = '$idcount'";
                        $query3 = mysqli_query($conn, $updatedata);
                        if (!($query3)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                        $updatetask = 1;
                        $idcount++;
                    }
                }
            }
            $zipname = time() . ".zip";
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            foreach ($attaarray as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename=' . $zipname);
            readfile($zipname);
            $updatetask = 0;
            unlink($zipname);
        }
    }
}
