<?php
session_start();
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


include "components/header.php";
include "components/navigation.php";


?>



<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="assets\static\hero1.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Test Kepribadian</h1>
            <p class="lead">Website MBTI ini membantu pengguna menemukan tipe kepribadian mereka berdasarkan indikator Myers-Briggs Type Indicator. Dengan menjawab beberapa pertanyaan, pengguna dapat mengetahui tipe kepribadian mereka dari 16 tipe yang berbeda dan mendapatkan wawasan mengenai cara berpikir, interaksi, dan pengambilan keputusan mereka. Temukan kekuatan dan tantangan Anda serta tips pengembangan diri yang sesuai dengan tipe kepribadian Anda.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="#test"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Mulai Test</button></a>
            </div>
        </div>
    </div>
</div>

<div class="container d-flex justify-contetn-evenly mb-5">
    <div class=" flex-grow-1 m-1">
        <div class="card">
            <img src="assets\static\1.png" class="card-img-top m-auto" style="height: 200px; width: 200px;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Mulai kenali diri anda</h5>
                <p class="card-text">Jadilah diri Anda apa adanya dan jawab dengan jujur untuk mengetahui tipe kepribadian Anda yang sebenarnya.</p>
            </div>
        </div>
    </div>
    <div class=" flex-grow-1 m-1">
    <div class="card">
            <img src="assets\static\2.png" class="card-img-top m-auto" style="height: 200px; width: 200px;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Temukan Potensi Anda</h5>
                <p class="card-text">Setelah mengetahui tipe kepribadian Anda, temukan potensi diri dan bagaimana cara mengoptimalkan kekuatan serta mengatasi tantangan yang ada.</p>
            </div>
        </div>
    </div>
</div>

<main class="container" id="test">
    <form method="post" action="hasil.php">
        <fieldset class="chkgroup d-flex justify-content-center" role="radiogroup" aria-labelledby="question">
            <?php foreach ($questions as $key => $value): ?>
                <legend id="question" class="mb-5"><?= $value['question'] ?></legend>
                <div class="d-flex justify-content-evenly mt-2">
                    <div>
                        <input value="7" id="<?= $value['id'] ?>c1" class="agree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c1">Sangat Setuju</label>
                    </div>
                    <div>
                        <input value="6" id="<?= $value['id'] ?>c2" class="agree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c2"></label>
                    </div>
                    <div>
                        <input value="5" id="<?= $value['id'] ?>c3" class="agree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c3"></label>
                    </div>
                    <div>
                        <input value="4" id="<?= $value['id'] ?>c4" class="neutral" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c4">Netral</label>
                    </div>
                    <div>
                        <input value="3" id="<?= $value['id'] ?>c5" class="disagree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c5"></label>
                    </div>
                    <div>
                        <input value="2" id="<?= $value['id'] ?>c6" class="disagree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c6"></label>
                    </div>
                    <div>
                        <input value="1" id="<?= $value['id'] ?>c7" class="disagree" type="radio" name="<?= $value['id'] ?>" />
                        <label class="label-mbti" for="<?= $value['id'] ?>c7">Sangat Tidak Setuju</label>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-center my-3 w-100 px-5">
                <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
            </div>
        </fieldset>


    </form>


</main>

<?php
include "components/footer.php";
?>

