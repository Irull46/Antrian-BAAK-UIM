@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Grid Kiri --}}
        <div class="col-md-8 col-lg-9">
            {{-- Nomor Antrian --}}
            <div class="container-fluid">
                <div class="row bg-success py-4 py-sm-5 mb-4">
                    <div class="col-md-8 pb-3 pb-md-0">
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
            
            {{-- 5 Teller --}}
            <div class="row mb-4">
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
        
        {{-- Grid Kanan --}}
        <div class="col-md-4 col-lg-3">
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
            <div class="bg-success pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Jam Digital</h4>
            </div>
            <div class="bg-warning px-3 py-3">
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
</div>

<script>
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

    setInterval(updateTime, 100)
</script>
@endsection
