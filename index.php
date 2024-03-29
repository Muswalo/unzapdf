<?php
session_start();
require_once('./templates/generate_card.php');
require_once('./scripts/db_connection.php');

$recordsPerPage = 9;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $recordsPerPage;
$schools = [
    'ns',
    'hss',
    'agric',
    'law',
    'edu',
    'vet',
    'eng',
    'mines',
    'other'
];

if (isset($_GET['sort']) && in_array(strtolower($_GET['sort']), $schools)) {
    // Sort functionality
    $type = $_GET['sort'];
    $sql = "SELECT * FROM pdfs WHERE type = ? LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    $offset = ($page - 1) * $recordsPerPage;
    mysqli_stmt_bind_param($stmt, "sii", $type, $offset, $recordsPerPage);
} else if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Search functionality
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM pdfs WHERE name LIKE ? LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    $offset = ($page - 1) * $recordsPerPage;
    $searchTerm = '%' . $searchTerm . '%';
    mysqli_stmt_bind_param($stmt, "sii", $searchTerm, $offset, $recordsPerPage);
} else {
    // Default functionality
    $sql = "SELECT * FROM pdfs LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    $offset = ($page - 1) * $recordsPerPage;
    mysqli_stmt_bind_param($stmt, "ii", $offset, $recordsPerPage);
}

if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        function formatDate($date)
        {
            date_default_timezone_set('Africa/Lusaka');
            $now = time();
            $timestamp = strtotime($date);
            $diff = $now - $timestamp;
            if ($diff < 0) {
                return 'Date is in the future';
            }
            $intervals = array(
                31536000 => 'year',
                2592000 => 'month',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );
            foreach ($intervals as $secs => $str) {
                if ($diff >= $secs) {
                    $num = floor($diff / $secs);
                    return $num . ' ' . $str . ($num > 1 ? 's' : '') . ' ago';
                }
            }
            return 'just now';
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Unza Pdf</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="./css/nav.css">
            <link rel="stylesheet" href="./css/card.css">
            <script src="./js/index.js" defer></script>
        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <img src="./img/logo-transparent.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <form class="form-inline my-2 my-lg-0" action="" method="GET">
                        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <a class="btn btn-primary btn-add" href="upload.php">Upload Document</a>
                </div>
            </nav>

            <main style="margin-bottom: 80px;">
                <form class="slider">
                    <button type="submit" class="btn btn-other" name="sort" value="">ALL</button>
                    <button type="submit" class="btn btn-ns" name="sort" value="ns">NS</button>
                    <button type="submit" class="btn btn-hss" name="sort" value="hss">HSS</button>
                    <button type="submit" class="btn btn-agric" name="sort" value="agric">AGRIC</button>
                    <button type="submit" class="btn btn-law" name="sort" value="law">LAW</button>
                    <button type="submit" class="btn btn-edu" name="sort" value="edu">EDU</button>
                    <button type="submit" class="btn btn-vet" name="sort" value="vet">VET</button>
                    <button type="submit" class="btn btn-eng" name="sort" value="eng">ENG</button>
                    <button type="submit" class="btn btn-mines" name="sort" value="mines">MINES</button>
                    <button type="submit" class="btn btn-other" name="sort" value="other">OTHER</button>
                </form>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $imgSrc = "./img/david_begg.jpg";
                    $title = $row['name'];
                    $author = $row['creator'];
                    $timeAgo = formatDate($row['date']);
                    $recommendation = $row['recommendation'];
                    $id = $row['id'];
                    generate_card($imgSrc, $title, $author, $timeAgo, $recommendation, $id);
                }
                ?>
            </main>

            <div class="pagination">
                <?php
                $totalPagesSql = "SELECT COUNT(*) AS total FROM pdfs";
                $totalResult = mysqli_query($conn, $totalPagesSql);
                $totalRows = mysqli_fetch_assoc($totalResult)['total'];
                $totalPages = ceil($totalRows / $recordsPerPage);

                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="?page=' . $i . '" class="btn btn-primary">' . $i . '</a>';
                }
                ?>
            </div>

            <footer class="footer mt-auto py-3 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0" style="color: white;">&copy; <?php echo date("Y"); ?> UNZAPDF</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <p class="mb-0" style="color: white;">Developed by Emmanuel Muswalo</p>
                        </div>
                    </div>
                </div>
            </footer>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>

        </html>
<?php
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to execute statement'));
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to prepare statement'));
}
mysqli_close($conn);
?>