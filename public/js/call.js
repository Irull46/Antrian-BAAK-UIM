let flag = false;
let queue = [];

async function panggil() {
    if (flag) {
        queue.push(true);
    } else {
        const bell_in = document.getElementById("bell_in");
        const bell_out = document.getElementById("bell_out");
        const nomorAntrian = document.getElementById("nomorAntrian");

        let nomor_antrian = document.getElementById("nomor_antrian").innerText;
        let bagian = nomor_antrian.charAt(0);
        let nilai = nomor_antrian.slice(1);

        let ab = document.getElementById(`bagian_${bagian}`);

        let nomor = document.getElementById(`nomor${nilai}`);
        let sepuluh = document.getElementById(`nomor10`);
        let sebelas = document.getElementById(`nomor11`);
        let seratus = document.getElementById(`nomor100`);

        const puluh = document.getElementById("puluh");
        const belas = document.getElementById("belas");
        const ratus = document.getElementById("ratus");

        let teller_id = document.getElementById("posisi").innerText;
        let teller = document.getElementById(`teller${teller_id}`);

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
                putar();
                queue.shift();
            }
        }

        bell_out.onended = function () {
            flag = false;
            lanjutPutar();
        };

        putar();
    }
}
