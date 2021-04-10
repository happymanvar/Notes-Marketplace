<?php
session_start();

include 'db_conntect.php';

if (!empty($_GET['id'])) {
    $noteid = $_GET['id'];
    $attaarray = array();
    $attanamearray = array();

    $getdetail = "SELECT * FROM sellernotes WHERE ID = $noteid";
    $query = mysqli_query($conn, $getdetail);
    if ($query) {
        $detail = mysqli_fetch_assoc($query);
        $sellerid = $detail['SellerID'];
        $ispaid = $detail['IsPaid'];
        $price = $detail['SellingPrice'];
        $title = $detail['Title'];
        $category = $detail['Category'];

        $getatta = "SELECT * FROM sellernotesattachements WHERE NoteID = $noteid";
        $attachements = mysqli_query($conn, $getatta);
        if ($attachements) {
            $count = mysqli_num_rows($attachements);

            while ($atta = mysqli_fetch_assoc($attachements)) {
                $fpath = $atta['FilePath'];
                if (file_exists($fpath)) {
                    array_push($attaarray, $atta['FilePath']);
                    array_push($attanamearray, $atta['FileName']);
                } else {
                    echo "file not found";
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
            unlink($zipname);
        }
    }
}
