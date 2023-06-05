@extends('layouts.app')

@section('content')
<div class="h-100 pt-80-sip">
    <div class="container-fluid">
        <div class="row">
            {{-- Left Column --}}
            <div class="col-md-8 col-lg-9">
                <div class="container-fluid">
                    <div class="row bg-success py-3 py-md-5 mb-2">
                        <div class="col-md-8 pb-2 pb-md-0">
                            <div class="ms-md-5 bg-white border border-5">
                                <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Nomor Antrian</h2>
                                <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="nomor_antrian">-</h1>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="me-md-5 bg-white border border-5">
                                <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Teller</h2>
                                <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="posisi">-</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                <div class="bg-success pt-3 pb-1 px-2">
                    <h4 class="fw-bold text-center text-light">Sisa Antrian A</h4>
                </div>
                <div class="bg-warning px-3 py-3 mb-md-4">
                    <h1 class="fw-bold text-center" id="sisaA">-</h1>
                </div>
                <div class="bg-success pt-3 pb-1 px-2">
                    <h4 class="fw-bold text-center text-light">Sisa Antrian B</h4>
                </div>
                <div class="bg-warning px-3 py-3 mb-md-4">
                    <h1 class="fw-bold text-center" id="sisaB">-</h1>
                </div>
            </div>
        </div>
            
        <div class="row">
            {{-- Left Column --}}
            <div class="col-md-8 col-lg-9">
                <div class="row mb-2 mb-md-0">
                    <div class="col-md">
                        <div class="bg-success pt-3 pb-1 px-2">
                            <h4 class="fw-bold text-center text-light">Teller 1</h4>
                        </div>
                        <div class="bg-warning px-3 py-3">
                            <div class="fw-bold text-center d-flex justify-content-center">
                                <h1 id="nomor_antrian1">-</h1>
                            </div>
                            <h5 class="fw-bold text-center" id="nama1">-</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="bg-success pt-3 pb-1 px-2">
                            <h4 class="fw-bold text-center text-light">Teller 2</h4>
                        </div>
                        <div class="bg-warning px-3 py-3">
                            <div class="fw-bold text-center d-flex justify-content-center">
                                <h1 id="nomor_antrian2">-</h1>
                            </div>
                            <h5 class="fw-bold text-center" id="nama2">-</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="bg-success pt-3 pb-1 px-2">
                            <h4 class="fw-bold text-center text-light">Teller 3</h4>
                        </div>
                        <div class="bg-warning px-3 py-3">
                            <div class="fw-bold text-center d-flex justify-content-center">
                                <h1 id="nomor_antrian3">-</h1>
                            </div>
                            <h5 class="fw-bold text-center" id="nama3">-</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="bg-success pt-3 pb-1 px-2">
                            <h4 class="fw-bold text-center text-light">Teller 4</h4>
                        </div>
                        <div class="bg-warning px-3 py-3">
                            <div class="fw-bold text-center d-flex justify-content-center">
                                <h1 id="nomor_antrian4">-</h1>
                            </div>
                            <h5 class="fw-bold text-center" id="nama4">-</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="bg-success pt-3 pb-1 px-2">
                            <h4 class="fw-bold text-center text-light">Teller 5</h4>
                        </div>
                        <div class="bg-warning px-3 py-3">
                            <div class="fw-bold text-center d-flex justify-content-center">
                                <h1 id="nomor_antrian5">-</h1>
                            </div>
                            <h5 class="fw-bold text-center" id="nama5">-</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Right Column --}}
            <div class="col-md-4 col-lg-3 d-clock">
                <div class="bg-success pt-3 pb-1 px-2">
                    <h4 class="fw-bold text-center text-light">Jam Digital</h4>
                </div>
                <div class="bg-warning px-3 py-3" style="height: 113px">
                    <div class="clock">
                        <div class="hours">
                            <div class="first">
                                <div class="number">0</div>
                            </div>
                            <div class="second">
                                <div class="number">0</div>
                            </div>
                        </div>
        
                        <div class="tick">:</div>
                        
                        <div class="minutes">
                            <div class="first">
                                <div class="number">0</div>
                            </div>
                            <div class="second">
                                <div class="number">0</div>
                            </div>
                        </div>
        
                        <div class="tick">:</div>
                        
                        <div class="seconds">
                            <div class="first">
                                <div class="number">0</div>
                            </div>
                            <div class="second infinite">
                                <div class="number">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="audio">
            <audio id="bell_in" src="{{ asset('audio/in.mp3') }}"></audio>
            <audio id="bell_out" src="{{ asset('audio/out.mp3') }}"></audio>
            <audio id="nomorAntrian" src="{{ asset('audio/nomor antrian.mp3') }}"></audio>
            <audio id="bagian_A" src="{{ asset('audio/a.mp3') }}"></audio>
            <audio id="bagian_B" src="{{ asset('audio/b.mp3') }}"></audio>
            <audio id="nomor1" src="{{ asset('audio/1.mp3') }}"></audio>
            <audio id="nomor2" src="{{ asset('audio/2.mp3') }}"></audio>
            <audio id="nomor3" src="{{ asset('audio/3.mp3') }}"></audio>
            <audio id="nomor4" src="{{ asset('audio/4.mp3') }}"></audio>
            <audio id="nomor5" src="{{ asset('audio/5.mp3') }}"></audio>
            <audio id="nomor6" src="{{ asset('audio/6.mp3') }}"></audio>
            <audio id="nomor7" src="{{ asset('audio/7.mp3') }}"></audio>
            <audio id="nomor8" src="{{ asset('audio/8.mp3') }}"></audio>
            <audio id="nomor9" src="{{ asset('audio/9.mp3') }}"></audio>
            <audio id="nomor10" src="{{ asset('audio/10.mp3') }}"></audio>
            <audio id="nomor11" src="{{ asset('audio/11.mp3') }}"></audio>
            <audio id="nomor100" src="{{ asset('audio/100.mp3') }}"></audio>
            <audio id="belas" src="{{ asset('audio/belas.mp3') }}"></audio>
            <audio id="puluh" src="{{ asset('audio/puluh.mp3') }}"></audio>
            <audio id="ratus" src="{{ asset('audio/ratus.mp3') }}"></audio>
            <audio id="teller1" src="{{ asset('audio/teller1.mp3') }}"></audio>
            <audio id="teller2" src="{{ asset('audio/teller2.mp3') }}"></audio>
            <audio id="teller3" src="{{ asset('audio/teller3.mp3') }}"></audio>
            <audio id="teller4" src="{{ asset('audio/teller4.mp3') }}"></audio>
            <audio id="teller5" src="{{ asset('audio/teller5.mp3') }}"></audio>
        </div>
    </div>
</div>

<script>
    // Get Queue Number, Teller Position, Teller Name, and Rest of The Queue
    setInterval(async function() {
        try {
            const response = await fetch('{{ route('home.ajax') }}', {
                method: 'GET'
            });
            if (response.ok) {
                const responseData = await response.json();

                document.getElementById("nomor_antrian").innerHTML = responseData.nomor_antrian;
                document.getElementById("posisi").innerHTML = responseData.posisi;
                document.getElementById("sisaA").innerHTML = responseData.sisaA;
                document.getElementById("sisaB").innerHTML = responseData.sisaB;
                
                // Looping untuk menampilkan 5 data nomor antrian dan 5 nama teller
                for (let i = 1; i <= 5; i++) {
                    document.getElementById(`nomor_antrian${i}`).innerHTML = responseData[`nomor_antrian${i}`];
                    document.getElementById(`nama${i}`).innerHTML = responseData[`nama${i}`];
                }
            } else {
                console.log('Data tidak ditemukan!');
            }
        } catch (error) {
            console.log(error);
        }
    }, 1000);
    

    // Call Queue Number
    let flag = false;
    let queue = [];

    async function panggil(data) {
        if (flag) {
            queue.push(data);
        } else {
            // Get Value from Data Parameter
            let bagian = data.data[0];
            let nilai = data.data[1];
            let posisi = data.data[2];
            
            // Get Audio by Id in Home View
            const bell_in = document.getElementById("bell_in");
            const bell_out = document.getElementById("bell_out");
            const nomorAntrian = document.getElementById("nomorAntrian");

            let ab = document.getElementById(`bagian_${bagian}`); 
            let nomor = document.getElementById(`nomor${nilai}`);
            let teller = document.getElementById(`teller${posisi}`);

            const sepuluh = document.getElementById(`nomor10`);
            const sebelas = document.getElementById(`nomor11`);
            const seratus = document.getElementById(`nomor100`);

            const puluh = document.getElementById("puluh");
            const belas = document.getElementById("belas");
            const ratus = document.getElementById("ratus");


            function opening() {
                bell_in.play();

                setTimeout(() => {
                    nomorAntrian.play();
                }, bell_in.duration * 1000);

                setTimeout(() => {
                    ab.play();
                }, (bell_in.duration + nomorAntrian.duration) * 1000);

                return bell_in.duration + nomorAntrian.duration + ab.duration; // Jumlah durasi audio opening (bell_in, nomorAntrian, dan ab)
            }

            function closing(jeda) {
                setTimeout(() => {
                    teller.play();
                }, jeda);

                teller.addEventListener("ended", function () {
                    bell_out.play();
                });
            }

            function putar() {
                flag = true;

                let durasi = opening();

                if (nilai <= 9) {
                    setTimeout(() => {
                        nomor.play();
                    }, (durasi - 0.3) * 1000);

                    closing((durasi + nomor.duration - 0.3) * 1000);
                } else if (nilai >= 10 && nilai <= 99) {
                    let puluhan = parseInt(nilai.charAt(0));
                    let satuan = parseInt(nilai.charAt(1));
                    let nomor_puluhan = document.getElementById(`nomor${puluhan}`);
                    let nomor_satuan = document.getElementById(`nomor${satuan}`);

                    if (puluhan == 1 && satuan == 0) {
                        setTimeout(() => {
                            sepuluh.play();
                        }, (durasi - 0.3) * 1000);

                        closing((durasi + sepuluh.duration - 0.3) * 1000);
                    } else if (puluhan == 1 && satuan == 1) {
                        setTimeout(() => {
                            sebelas.play();
                        }, (durasi - 0.3) * 1000);

                        closing((durasi + sebelas.duration - 0.3) * 1000);
                    } else if (puluhan == 1 && satuan > 1) {
                        setTimeout(() => {
                            nomor_satuan.play();
                        }, (durasi - 0.3) * 1000);
                        setTimeout(() => {
                            belas.play();
                        }, (durasi + nomor_satuan.duration - 0.4) * 1000);

                        closing(
                            (durasi +
                                nomor_satuan.duration +
                                belas.duration -
                                0.4) *
                                1000
                        );
                    } else if (puluhan > 1 && satuan == 0) {
                        setTimeout(() => {
                            nomor_puluhan.play();
                        }, (durasi - 0.3) * 1000);
                        setTimeout(() => {
                            puluh.play();
                        }, (durasi + nomor_puluhan.duration - 0.44) * 1000);

                        closing(
                            (durasi +
                                nomor_puluhan.duration +
                                puluh.duration -
                                0.44) *
                                1000
                        );
                    } else if (puluhan > 1 && satuan > 0) {
                        setTimeout(() => {
                            nomor_puluhan.play();
                        }, (durasi - 0.3) * 1000);
                        setTimeout(() => {
                            puluh.play();
                        }, (durasi + nomor_puluhan.duration - 0.43) * 1000);
                        setTimeout(() => {
                            nomor_satuan.play();
                        }, (durasi + nomor_puluhan.duration + puluh.duration - 0.55) * 1000);

                        closing(
                            (durasi +
                                nomor_puluhan.duration +
                                puluh.duration +
                                nomor_satuan.duration -
                                0.55) *
                                1000
                        );
                    } else {
                        closing((durasi - 0.3) * 1000);
                    }
                } else if (nilai >= 100 && nilai <= 999) {
                    let ratusan = parseInt(nilai.charAt(0));
                    let puluhan = parseInt(nilai.charAt(1));
                    let satuan = parseInt(nilai.charAt(2));
                    let nomor_ratusan = document.getElementById(`nomor${ratusan}`);
                    let nomor_puluhan = document.getElementById(`nomor${puluhan}`);
                    let nomor_satuan = document.getElementById(`nomor${satuan}`);

                    if (ratusan == 1) {
                        // * Ratusan dimulai angka 1
                        setTimeout(() => {
                            seratus.play();
                        }, (durasi - 0.3) * 1000);

                        if (puluhan == 0 && satuan > 0) {
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + seratus.duration - 0.56) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    nomor_satuan.duration -
                                    0.56) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan == 0) {
                            setTimeout(() => {
                                sepuluh.play();
                            }, (durasi + seratus.duration - 0.56) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    sepuluh.duration -
                                    0.56) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan == 1) {
                            setTimeout(() => {
                                sebelas.play();
                            }, (durasi + seratus.duration - 0.56) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    sebelas.duration -
                                    0.56) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan > 1) {
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + seratus.duration - 0.59) * 1000);
                            setTimeout(() => {
                                belas.play();
                            }, (durasi + seratus.duration + nomor_satuan.duration - 0.84) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    nomor_satuan.duration +
                                    belas.duration -
                                    0.83) *
                                    1000
                            );
                        } else if (puluhan > 1 && satuan == 0) {
                            setTimeout(() => {
                                nomor_puluhan.play();
                            }, (durasi + seratus.duration - 0.59) * 1000);
                            setTimeout(() => {
                                puluh.play();
                            }, (durasi + seratus.duration + nomor_puluhan.duration - 0.83) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    nomor_puluhan.duration +
                                    puluh.duration -
                                    0.83) *
                                    1000
                            );
                        } else if (puluhan > 1 && satuan > 0) {
                            setTimeout(() => {
                                nomor_puluhan.play();
                            }, (durasi + seratus.duration - 0.59) * 1000);
                            setTimeout(() => {
                                puluh.play();
                            }, (durasi + seratus.duration + nomor_puluhan.duration - 0.83) * 1000);
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + seratus.duration + nomor_puluhan.duration + puluh.duration - 1) * 1000);

                            closing(
                                (durasi +
                                    seratus.duration +
                                    nomor_puluhan.duration +
                                    puluh.duration +
                                    nomor_satuan.duration -
                                    1) *
                                    1000
                            );
                        } else {
                            closing((durasi + seratus.duration - 0.3) * 1000);
                        }
                    } else if (ratusan > 1) {
                        // * Ratusan tidak dimulai angka 1
                        setTimeout(() => {
                            nomor_ratusan.play();
                        }, (durasi - 0.3) * 1000);
                        setTimeout(() => {
                            ratus.play();
                        }, (durasi + nomor_ratusan.duration - 0.47) * 1000);

                        if (puluhan == 0 && satuan > 0) {
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.65) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    nomor_satuan.duration -
                                    0.65) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan == 0) {
                            setTimeout(() => {
                                sepuluh.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.67) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    sepuluh.duration -
                                    0.67) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan == 1) {
                            setTimeout(() => {
                                sebelas.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.67) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    sebelas.duration -
                                    0.67) *
                                    1000
                            );
                        } else if (puluhan == 1 && satuan > 1) {
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.66) * 1000);
                            setTimeout(() => {
                                belas.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration + nomor_satuan.duration - 0.84) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    nomor_satuan.duration +
                                    belas.duration -
                                    0.84) *
                                    1000
                            );
                        } else if (puluhan > 1 && satuan == 0) {
                            setTimeout(() => {
                                nomor_puluhan.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.66) * 1000);
                            setTimeout(() => {
                                puluh.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration + nomor_puluhan.duration - 0.85) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    nomor_puluhan.duration +
                                    puluh.duration -
                                    0.85) *
                                    1000
                            );
                        } else if (puluhan > 1 && satuan > 0) {
                            setTimeout(() => {
                                nomor_puluhan.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration - 0.8) * 1000);
                            setTimeout(() => {
                                puluh.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration + nomor_puluhan.duration - 0.98) * 1000);
                            setTimeout(() => {
                                nomor_satuan.play();
                            }, (durasi + nomor_ratusan.duration + ratus.duration + nomor_puluhan.duration + puluh.duration - 1.1) * 1000);

                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration +
                                    nomor_puluhan.duration +
                                    puluh.duration +
                                    nomor_satuan.duration -
                                    1.1) *
                                    1000
                            );
                        } else {
                            closing(
                                (durasi +
                                    nomor_ratusan.duration +
                                    ratus.duration -
                                    0.6) *
                                    1000
                            );
                        }
                    }
                }
            }

            function lanjutPutar() {
                if (queue.length > 0) {
                    panggil(queue[0]);
                    queue.shift();
                }
            }

            bell_out.onended = function () {
                flag = false;
                lanjutPutar();
            };

            putar();

            // // Show Queue Number and Teller Position to Home View - based on The Sound Being Played
            // document.getElementById('nomor_antrian').innerHTML = data.data[0] + data.data[1];
            // document.getElementById('posisi').innerHTML = data.data[2];
        }
    }

    // Listening For Event Broadcasts
    document.addEventListener("DOMContentLoaded", function(event) { 
        Echo.channel(`call-execute`)
            .listen('CallExecute', (data) => {
                panggil(data);
                console.log(`${data.data[0]} / ${data.data[1]} / ${data.data[2]}`);
            });
    });


    // Digital Clock
    let hoursContainer = document.querySelector('.hours')
    let minutesContainer = document.querySelector('.minutes')
    let secondsContainer = document.querySelector('.seconds')
    let tickElements = Array.from(document.querySelectorAll('.tick'))

    let last = new Date(0)
    last.setUTCHours(-1)

    let tickState = true

    function updateTime() {
        let now = new Date

        let lastHours = last.getHours().toString()
        let nowHours = now.getHours().toString()
        if (lastHours !== nowHours) {
            updateContainer(hoursContainer, nowHours)
        }

        let lastMinutes = last.getMinutes().toString()
        let nowMinutes = now.getMinutes().toString()
        if (lastMinutes !== nowMinutes) {
            updateContainer(minutesContainer, nowMinutes)
        }

        let lastSeconds = last.getSeconds().toString()
        let nowSeconds = now.getSeconds().toString()
        if (lastSeconds !== nowSeconds) {
            //tick()
            updateContainer(secondsContainer, nowSeconds)
        }

        last = now
    }

    function tick() {
        tickElements.forEach(t => t.classList.toggle('tick-hidden'))
    }

    function updateContainer(container, newTime) {
        let time = newTime.split('')

        if (time.length === 1) {
            time.unshift('0')
        }


        let first = container.firstElementChild
        if (first.lastElementChild.textContent !== time[0]) {
            updateNumber(first, time[0])
        }

        let last = container.lastElementChild
        if (last.lastElementChild.textContent !== time[1]) {
            updateNumber(last, time[1])
        }
    }

    function updateNumber(element, number) {
        let second = element.lastElementChild.cloneNode(true)
        second.textContent = number

        element.appendChild(second)
        element.classList.add('move')

        setTimeout(function () {
            element.classList.remove('move')
        }, 990)
        setTimeout(function () {
            element.removeChild(element.firstElementChild)
        }, 990)
    }

    setInterval(updateTime, 100);
</script>
@endsection
