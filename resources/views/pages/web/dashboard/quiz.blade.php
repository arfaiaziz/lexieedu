<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Quiz App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            .bg-button{
                background: #30CAEE;
            }
            .bg-button:hover{
                background: #3099fb;
            }
        </style>
    </head>
    <body class="bg-white font-sans min-h-screen flex flex-col">

        <main class="flex-grow">
            <header class="p-2 flex justify-between items-center bg-white shadow">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Lexie Edu Logo" class="h-16">
                </div>
                <div class="w-full text-center text-2xl font-bold">
                    <div id="timer" class="text-3xl mb-4">60:00</div>
                </div>
            </header>
            <div class="max-w-4xl mx-auto py-10">
                <div class="text-center text-2xl font-bold mb-6">
                    <h2 id="question-text" class="text-xl font-semibold">Loading...</h2>
                </div>
                <div class="audio-wrapper hidden text-center my-4">
                    <audio id="current-audio" controls class="mx-auto hidden">
                        <source src="" type="audio/mpeg">
                        Browser Anda tidak mendukung pemutar audio.
                    </audio>
                </div>
                <div id="options" class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4"></div>


                <div class="flex justify-between items-center mt-10 px-4">
                    <button id="back-btn" class="bg-gray-400 text-white px-6 py-2 rounded hidden mr-2">Back</button>
                    <div class="w-full flex flex-row justify-center items-center">
                        <div class="flex space-x-2" id="pagination"></div>
                    </div>
                    <button id="next-btn" class="bg-button text-white px-6 py-2 rounded">Next</button>
                </div>
            </div>
            <input type="text" id="nama" name="nama" value="{{$request->nama}}" required hidden>
            <input type="number" id="umur" name="umur" value="{{$request->umur}}" required hidden>
            <input type="text" id="alamat" name="alamat" value="{{$request->alamat}}" required hidden>
            <input type="text" id="email" name="email" value="{{$request->email}}" required hidden>
            <input type="text" id="instansi" name="instansi" value="{{$request->instansi}}" required hidden>
            <input type="text" id="level" name="level" value="{{$request->level}}" required hidden>
            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
        </main>


        @include('layouts.footer-web')

        <script>
            const questions         = <?php echo json_encode($pertanyaan, JSON_UNESCAPED_UNICODE); ?>;

            let currentQuestion     = 0;
            const answers           = new Array(questions.length).fill(null);

            const questionText      = document.getElementById('question-text');
            const optionsContainer  = document.getElementById('options');
            const nextBtn           = document.getElementById('next-btn');
            const pagination        = document.getElementById('pagination');

            function renderQuestion(index) {
                const q = questions[index];
                questionText.textContent = q.text;
                optionsContainer.innerHTML = '';

                if (q.audio) {
                    const fileName = q.audio.split('/').pop();
                    const audioUrl = `/audio-soal/${fileName}`;

                    $('#current-audio')
                        .removeClass('hidden')
                        .attr('src', audioUrl)[0].load();
                    $('.audio-wrapper').removeClass('hidden');
                } else {
                    $('#current-audio')
                        .addClass('hidden')
                        .attr('src', '')[0].load();
                    $('.audio-wrapper').addClass('hidden');
                }

                q.options.forEach((option, i) => {
                    const div = document.createElement('div');
                    const selected = answers[index]?.jawaban_peserta === i;
                    div.className = `border rounded p-4 cursor-pointer ${selected ? 'bg-blue-100 border-blue-500' : 'bg-white hover:bg-gray-100'}`;
                    div.textContent = option;
                    // div.onclick = () => {
                    //     answers[index] = i;
                    //     renderQuestion(index);
                    // };

                    div.onclick = () => {
                        answers[index] = {
                            id_soal: q.id,
                            jawaban_peserta: i
                        };
                        renderQuestion(index);
                    };

                    optionsContainer.appendChild(div);
                });
                renderPagination();
            }

            function renderPagination() {
                pagination.innerHTML = '';
                for (let i = 0; i < questions.length; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i + 1;

                    const isCurrent = currentQuestion === i;
                    const isAnswered = answers[i] !== null;

                    btn.className = `w-8 h-8 rounded mx-1 font-bold ${
                        isCurrent
                            ? 'bg-blue-800 text-white'
                            : isAnswered
                                ? 'bg-green-500 text-white'
                                : 'bg-gray-300 text-black'
                    }`;

                    btn.onclick = () => {
                        currentQuestion = i;
                        renderQuestion(currentQuestion);
                    };

                    pagination.appendChild(btn);
                }
            }


            nextBtn.onclick = () => {
                if (currentQuestion < questions.length - 1) {
                    currentQuestion++;
                    renderQuestion(currentQuestion);
                } else {
                    // Kirim jawaban ke server
                    kirimTest();
                }
            }

            const backBtn = document.getElementById('back-btn');

            backBtn.onclick = () => {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    renderQuestion(currentQuestion);
                }
            };

            function renderQuestion(index) {
                const q = questions[index];
                questionText.textContent = q.text;
                optionsContainer.innerHTML = '';

                if (q.audio) {
                    const fileName = q.audio.split('/').pop();
                    const audioUrl = `/audio-soal/${fileName}`;

                    $('#current-audio')
                        .removeClass('hidden')
                        .attr('src', audioUrl)[0].load();
                    $('.audio-wrapper').removeClass('hidden');
                } else {
                    $('#current-audio')
                        .addClass('hidden')
                        .attr('src', '')[0].load();
                    $('.audio-wrapper').addClass('hidden');
                }

                q.options.forEach((option, i) => {
                    const div = document.createElement('div');
                    const selected = answers[index]?.jawaban_peserta === i;
                    div.className = `border rounded p-4 cursor-pointer ${selected ? 'bg-blue-100 border-blue-500' : 'bg-white hover:bg-gray-100'}`;
                    div.textContent = option;

                    div.onclick = () => {
                        answers[index] = {
                            id_soal: q.id,
                            jawaban_peserta: i
                        };
                        renderQuestion(index);
                    };

                    optionsContainer.appendChild(div);
                });


                if (index > 0) {
                    backBtn.classList.remove('hidden');
                } else {
                    backBtn.classList.add('hidden');
                }

                if (index === questions.length - 1) {
                    nextBtn.textContent = 'Finish';
                } else {
                    nextBtn.textContent = 'Next';
                }

                renderPagination();
            }



            function kirimTest(){
                let nama        = $('#nama').val().trim();
                let umur        = $('#umur').val();
                let alamat      = $('#alamat').val();
                let email       = $('#email').val();
                let instansi    = $('#instansi').val();
                let level       = $('#level').val();

                console.log("Final Answers:", answers);
                fetch('/submit-quiz', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ answers, nama, umur, alamat, email, instansi, level, _token: $('input[name="_token"]').val() })
                })
                .then(res => res.json())
                .then(data => {
                    location.href = '/selesai/'+data.data.id_peserta;
                    // console.log(data.data.id_peserta);
                })
                .catch(err => alert("Gagal mengirim jawaban."));
            }

            // Timer countdown
            let timeLeft = 60 * 60;
            const timerEl = document.getElementById('timer');
            const timer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timer);
                alert("Waktu habis! Kirim otomatis");
                kirimTest();
            }
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            timeLeft--;
            }, 1000);

            // Init
            renderQuestion(currentQuestion);
        </script>
    </body>
</html>
