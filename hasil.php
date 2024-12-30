<?php
session_start();
include 'database/Database.php';
include 'database/models/Mbti.php';

$Mbti = new Mbti(Database::getInstance()->getConnection());
$Mbti_data = $Mbti->readOneByUser($_SESSION['user']['user_id']);

if ($Mbti_data != null) {
    header('Location: hasil_db.php');
    return;
}

$questions = [
    [
        'id' => 'q1',
        'question' => 'Saya merasa energik ketika berinteraksi dengan banyak orang.',
        'type' => 'E',
    ],
    [
        'id' => 'q2',
        'question' => 'Saya cenderung merenung secara mendalam dan memilih untuk sendiri ketika berpikir.',
        'type' => 'I',
    ],
    [
        'id' => 'q3',
        'question' => 'Saya lebih suka memiliki rutinitas yang teratur dan terencana.',
        'type' => 'J',
    ],
    [
        'id' => 'q4',
        'question' => 'Saya merasa lebih fleksibel dan suka berimprovisasi.',
        'type' => 'P',
    ],
    [
        'id' => 'q5',
        'question' => 'Saya sering mengandalkan perasaan saya dalam mengambil keputusan.',
        'type' => 'F',
    ],
    [
        'id' => 'q6',
        'question' => 'Saya lebih suka keputusan yang didasarkan pada logika dan analisis objektif.',
        'type' => 'T',
    ],
    [
        'id' => 'q7',
        'question' => 'Saya tertarik pada fakta dan realitas yang bisa saya amati langsung.',
        'type' => 'S',
    ],
    [
        'id' => 'q8',
        'question' => 'Saya sering memikirkan kemungkinan-kemungkinan di masa depan.',
        'type' => 'N',
    ]
];


$scores = [
    "E" => [
        "score" => 0,
        "full_name" => "Extroversion",
        "description" => "Ekstroversi: Cenderung mendapatkan energi dari interaksi sosial dan lingkungan luar. Biasanya lebih berorientasi pada tindakan dan senang berada di lingkungan yang ramai."
    ],
    "I" => [
        "score" => 0,
        "full_name" => "Introversion",
        "description" => "Introversi: Cenderung mendapatkan energi dari waktu sendiri dan refleksi internal. Biasanya lebih fokus pada dunia dalam, introspektif, dan suka suasana yang tenang."
    ],
    "S" => [
        "score" => 0,
        "full_name" => "Sensing",
        "description" => "Sensing: Cenderung fokus pada fakta konkret, detail, dan informasi yang dapat dirasakan langsung dengan pancaindra. Lebih suka pendekatan yang praktis dan realistis."
    ],
    "N" => [
        "score" => 0,
        "full_name" => "Intuition",
        "description" => "Intuisi: Cenderung fokus pada gambaran besar, pola, dan kemungkinan yang abstrak. Suka berpikir secara konseptual dan lebih tertarik pada ide-ide masa depan daripada fakta saat ini."
    ],
    "T" => [
        "score" => 0,
        "full_name" => "Thinking",
        "description" => "Thinking: Mengambil keputusan berdasarkan logika dan analisis objektif. Lebih cenderung menilai situasi dengan objektivitas daripada mempertimbangkan perasaan."
    ],
    "F" => [
        "score" => 0,
        "full_name" => "Feeling",
        "description" => "Feeling: Mengambil keputusan berdasarkan nilai pribadi, empati, dan bagaimana hal itu akan memengaruhi orang lain. Lebih sensitif terhadap kebutuhan dan perasaan orang lain."
    ],
    "J" => [
        "score" => 0,
        "full_name" => "Judging",
        "description" => "Judging: Cenderung menyukai keteraturan, rencana, dan keputusan yang tegas. Menyukai struktur dan lebih suka menyelesaikan tugas daripada membiarkan hal-hal terbuka."
    ],
    "P" => [
        "score" => 0,
        "full_name" => "Perceiving",
        "description" => "Perceiving: Lebih fleksibel, spontan, dan terbuka terhadap kemungkinan baru. Cenderung lebih adaptif, suka mengeksplorasi, dan tidak terburu-buru membuat keputusan."
    ]
];


$user_answers = $_POST;

// Menghitung skor berdasarkan jawaban user
foreach ($user_answers as $question_id => $score) {
    foreach ($questions as $question) {
        if ($question['id'] === $question_id) {
            $type = $question['type'];
            $scores[$type]["score"] += (int)$score;
            break;
        }
    }
}

if (isset($_SESSION['user'])) {
    $Mbti = new Mbti(Database::getInstance()->getConnection());
    $Mbti->e = $scores['E']["score"];
    $Mbti->i = $scores['I']["score"];
    $Mbti->s = $scores['S']["score"];
    $Mbti->n = $scores['N']["score"];
    $Mbti->t = $scores['T']["score"];
    $Mbti->f = $scores['F']["score"];
    $Mbti->j = $scores['J']["score"];
    $Mbti->p = $scores['P']["score"];
    $Mbti->userId = $_SESSION['user']['user_id'];

    $Mbti->create();
}else{
    header('Location: login.php');
}

// Menentukan tipe MBTI berdasarkan skor tertinggi
$MBTI_type = '';
$MBTI_type .= ($scores['E']["score"] > $scores['I']["score"]) ? 'E' : 'I';
$MBTI_type .= ($scores['S']["score"] > $scores['N']["score"]) ? 'S' : 'N';
$MBTI_type .= ($scores['T']["score"] > $scores['F']["score"]) ? 'T' : 'F';
$MBTI_type .= ($scores['J']["score"] > $scores['P']["score"]) ? 'J' : 'P';

// Menampilkan hasil
// echo "Tipe MBTI Anda adalah: " . $MBTI_type;

// echo "Skor untuk setiap tipe:<br>";
// foreach ($scores as $type => $score) {
//     echo $type . ": " . $score . "<br>";

// }

include 'components/header.php';
include 'components/navigation.php';
?>

<div class="container">
    <h1 class="mb3"><?= $MBTI_type ?></h1>
    <div class="row ">
        <div class="col-md-4 px-2">
            <div class="card  d-flex justify-content-center align-items-center mr-2">
                <span class="mt-2 ">tipe kepribadian</span>
                <h5 class="mt-2"><?= $MBTI_type ?></h5>
                <img class="w-100 mt-5" style="height: 400px;" src="assets/static/mbti/svg/<?php echo strtolower($MBTI_type); ?>.svg" alt="">
            </div>
        </div>
        <div class="col-md-8 px-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h3>Hasil Tes MBTI</h3>
                </div>
                <div class="card-body">
                    <?php foreach ($scores as $value): ?>
                        <div class="m-auto">
                            <label for="customRange1" class="form-label"><?= $value['full_name'] ?> <?php echo number_format((float)$value['score'] / 7 * 100, 2) ?>% <span data-bs-toggle="tooltip" data-bs-title="<?= $value["description"] ?>">?</span></label>
                            <input disabled type="range" class="form-range" value="<?php echo number_format((float)$value['score'] / 7 * 100, 2) ?>" id="customRange<?= $value["full_name"] ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'components/footer.php';
?>