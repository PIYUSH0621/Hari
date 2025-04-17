<?php  
include('partials/_home_nav.php'); 
include 'feedback.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📖 Krishna Books Library</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .book-container {
            max-width: 94%;
            margin: 20px auto 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        }

        .book-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .pdf-item {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 8px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .pdf-item:hover {
            background: #f1f1f1;
        }

        .pdf-item img {
            width: 30px;
            margin-right: 10px;
        }

        .pdf-item a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
            font-size: 14px;
        }

        .pdf-item a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container book-container">
        <h2 class="book-title">📚 Devotion Books Library</h2>

        <div class="row">
            <?php 
            $books = [
                ["Aarti Book", "https://drive.google.com/file/d/1t26CR6xSlz4ZeQOudCKdVp3ud6ULN9wX/view?usp=sharing"],
                ["Bhagavad Gita", "https://drive.google.com/file/d/1k76EoF5RuPXZ_VPH0kSlNNpqfE0WxWbr/view?usp=sharing"],
                ["Bhaktmal Book", "https://drive.google.com/file/d/1-SbUNqIYSM5A-MRERmL6QtsgQtv7qkth/view?usp=sharing"],
                ["Sri chaitanya-Chariramrit", "https://drive.google.com/file/d/1qJ269zT9DtmO83wkmHgfodpPTDJb2CZf/view?usp=sharing"],
                ["Rasraj krsna","https://drive.google.com/file/d/13ODf0vDSor2_IYetQroDwmksN7YqvCMw/view?usp=sharing"],
                ["Leela Purushottam Shri Krishna","https://drive.google.com/file/d/10wPbteIHiixFfnlOOW01E_1T5vBp-pDx/view?usp=sharing"],
                ["Srimad Bhagavatam 1st Canto", "https://drive.google.com/file/d/1RLaUK-8kdb7SqMG0Q_pUIclK53HSVw_A/view?usp=sharing"],
                ["Srimad Bhagavatam 2nd Canto", "https://drive.google.com/file/d/1meb7vDhCCpMv9udEQFuEEaYOeCnG1TbK/view?usp=sharing"],
                ["Srimad Bhagavatam 3rd Canto Part 1", "https://drive.google.com/file/d/12hrAM_-LkYSfF5pm5lgCcsVpxCCu8zzN/view?usp=sharing"],
                ["Srimad Bhagavatam 3rd Canto Part 2", "https://drive.google.com/file/d/1kx6rRHig3CAed4bkvn1CnpxHXmAA2KAE/view?usp=sharing"],
                ["Srimad Bhagavatam 3rd Canto Part 3", "https://drive.google.com/file/d/1dv12VIoEKy6-yGQRQNXQZT3jlgo_mCib/view?usp=sharing"],
                ["Srimad Bhagavatam 3rd Canto Part 4", "https://drive.google.com/file/d/1waFTkQW1jcqVsv4tK1cuRgQnb_FEibqw/view?usp=sharing"],
                ["Srimad Bhagavatam 4th Canto Part 1", "https://drive.google.com/file/d/1GvKa5O3l30Aqw6C0l5WBbekTgJl0IZHV/view?usp=sharing"],
                ["Srimad Bhagavatam 4th Canto Part 2", "https://drive.google.com/file/d/1_DWXyWT88Qbha7OcEivbg-QuG70RJzVv/view?usp=sharing"],
                ["Srimad Bhagavatam 4th Canto Part 3", "https://drive.google.com/file/d/1pjkSaiWweyMy1IUXy2iof3M2rlxNHyBX/view?usp=sharing"],
                ["Srimad Bhagavatam 4th Canto Part 4", "https://drive.google.com/file/d/1pk3nDxMerg926nNQ9sNPgolujT8rG8vn/view?usp=sharing"],
                ["Srimad Bhagavatam 5th Canto Part 1", "https://drive.google.com/file/d/1jtLZomNFCrQHAIr3mASHMsrbdOEPf_mQ/view?usp=sharing"],
                ["Srimad Bhagavatam 5th Canto Part 2", "https://drive.google.com/file/d/1-jNvaGGhBenVVaSh10XXXAoHF4YygS6l/view?usp=sharing"],
                ["Srimad Bhagavatam 6th Canto", "https://drive.google.com/file/d/1lmExHFS5MW9EhaaYh2ByBhl542YBZtum/view?usp=sharing"],
                ["Srimad Bhagavatam 7th Canto Part 1", "https://drive.google.com/file/d/1zV-F7JLEkTwPV58_HMQf8NF1nsNkCUWx/view?usp=sharing"],
                ["Srimad Bhagavatam 7th Canto Part 2", "https://drive.google.com/file/d/1MjtFxm_WS3O80c9A06W7t5bnDVERdVw5/view?usp=sharing"],
                ["Srimad Bhagavatam 7th Canto Part 3", "https://drive.google.com/file/d/1FXj2cBRvQGmNfz_bqI-eCAQ0mXpxapq1/view?usp=sharing"],
                ["Srimad Bhagavatam 8th Canto ", "https://drive.google.com/file/d/1ZTtVL3Ypziv29eWmdI9Onbo6Ctj6Zchv/view?usp=sharing"],
                ["Srimad Bhagavatam 9th Canto ", "https://drive.google.com/file/d/1Dt3Sk-R5Exp1OUN5RL7kVipedT1tmelj/view?usp=sharing"],
                ["Srimad Bhagavatam 10th Canto Part 1", "https://drive.google.com/file/d/1vuJSLP5X_ddhOokMVgPA2_i0f1qPH5Cd/view?usp=sharing"],
                ["Srimad Bhagavatam 10th Canto Part 2", "https://drive.google.com/file/d/1nITZqi4p9CXmvf7pnGrttP67UOTyCSJ4/view?usp=sharing"],
                ["Srimad Bhagavatam 10th Canto Part 3", "https://drive.google.com/file/d/15efBjAUC0ZexcuyWV_J8dKyBnRCIkASQ/view?usp=sharing"],
                ["Srimad Bhagavatam 10th Canto Part 4", "https://drive.google.com/file/d/1Pz8rFvBRiDXI3kdz1cDZc4zht3TjrKt4/view?usp=sharing"],
                ["Srimad Bhagavatam 11th Canto Part 1", "https://drive.google.com/file/d/1xaJKQDqE09UqjO51ctlSUZ7c6wJTscPx/view?usp=sharing"],
                ["Srimad Bhagavatam 11th Canto Part 2", "https://drive.google.com/file/d/1Au9ZTTbut6qS8UgYzVF5IwSWyCMb3-oJ/view?usp=sharing"],
                ["Srimad Bhagavatam 12th Canto", "https://drive.google.com/file/d/1ZX6_vAaMA_uv-7cV9TFZKea8vaMQgLlZ/view?usp=sharing"]
            ];

            foreach ($books as $book) {
                echo '<div class="col-md-6 col-lg-3"> 
                        <a href="'.$book[1].'" target="_blank">
                        <div class="pdf-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF">
                            '.$book[0].'</div>
                        </a>
                      </div>';
            }
            ?>
        </div>
    </div>

    <?php 
     include 'discover.php'; 
     include 'partials/_footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
