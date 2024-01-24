@extends('base.index')
@section('content')
    <div class="w-screen h-screen bg-black">
        <div class="flex flex-col w-full h-full gap-y-1">
            <div class="flex flex-col w-full border-b-4 border-orange-500 md:flex-row">
                <x-title title="MONITORING ROBOT RAMA" />
                <x-title title="POLITEKNIK NEGERI SEMARANG" />
            </div>
            <div class="flex w-full h-full ">
                <div class="flex flex-col w-full h-full gap-y-1">
                    <x-block addition="w-full h-full gap-y-1 flex flex-col">
                        <x-card addition="flex gap-x-3 px-2 mt-1">
                            <div class="w-1/4 py-2 pl-3 bg-blue-500">
                                TIME
                            </div>
                            <div class="flex justify-between flex-1 px-3 py-2 bg-blue-500">
                                <div id="tanggal">

                                </div>
                            </div>
                        </x-card>

                        <x-card addition="flex gap-x-3 px-2 mt-1">
                            <div class="w-1/4 py-2 pl-3 bg-blue-500">
                                STATUS
                            </div>
                            <div class="flex justify-between flex-1 gap-x-4">
                                <div id="on"
                                    class="flex items-center justify-between flex-1 pl-4 font-bold text-black bg-emerald-300">
                                    ON
                                </div>
                                <div id="off"
                                    class="flex items-center justify-between flex-1 pl-4 font-bold text-white bg-red-500 border-red-500">
                                    OFF
                                </div>
                            </div>
                        </x-card>

                        <x-card addition="flex px-2 flex-1 h-full ">
                            <div class="flex items-center w-2/5 h-full pl-2 ">
                                <div id="baterai"
                                    class="right-0 flex w-full px-2 py-1 border-8 border-green-600 gap-x-3 h-36 md:h-36 xl:h-48 2xl:h-56 rounded-xl ">



                                </div>
                            </div>

                            <div class="flex items-center ">
                                <div class="w-8 h-16 py-2 pl-3 bg-green-600 ">

                                </div>
                            </div>
                            <div class="flex items-center flex-1 ml-1">
                                <div class="flex-1 py-2 pl-3 bg-blue-500 " id="analogBaterai">

                                </div>
                            </div>
                        </x-card>
                    </x-block>
                    <x-block addition="w-full h-full gap-y-1 flex flex-col">
                        <x-card addition="flex gap-x-3 relative px-2 mt-1" id="mapCard">
                        </x-card>
                    </x-block>
                </div>
                <div class="flex w-full h-full">
                    asa
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const onStatus = document.getElementById("on");
        const offStatus = document.getElementById("off");
        const analogBaterai = document.getElementById("analogBaterai");
        const baterai = document.getElementById("baterai");
        let status = 0;

        const updateDateTime = () => {
            const dateTimeOptions = {
                weekday: 'long', // Nama hari
                day: 'numeric', // Tanggal
                month: 'long', // Nama bulan
                year: 'numeric', // Tahun
                hour: 'numeric', // Jam
                minute: 'numeric', // Menit
                second: 'numeric', // Detik
                locale: 'id-ID' // Lokalisasi bahasa Indonesia
            };

            const now = new Date();
            const formattedDateTimeString = new Intl.DateTimeFormat('id-ID', dateTimeOptions).format(now);

            // Hilangkan kata "pukul"
            const formattedDateTimeWithoutPukul = formattedDateTimeString.replace('pukul', '').trim();
            const formattedDateTimeWithColon = formattedDateTimeString.replace('.', ':').trim();

            // Mendapatkan elemen berdasarkan ID
            const tanggal = document.getElementById("tanggal");

            // Mengatur nilai elemen dengan format yang diinginkan
            tanggal.innerText = formattedDateTimeWithoutPukul;
        };

        // Memanggil updateDateTime setiap detik
        const intervalId = setInterval(updateDateTime, 1000);



        //-----------------------------------------//

        const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8)
        const host = 'ws://192.168.1.103:1884/mqtt'
        const username = 'your_username'; // Ganti dengan username Anda
        const password = 'your_password'; // Ganti dengan password Anda

        const options = {
            keepalive: 60,
            clientId: clientId,
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000,
            will: {
                topic: 'WillMsg',
                payload: 'Connection Closed abnormally..!',
                qos: 0,
                retain: false
            },

        }
        console.log('Connecting mqtt client')
        const client = mqtt.connect(host, options)
        client.on('error', (err) => {
            console.log('Connection error: ', err)
            client.end()
        })
        client.on('reconnect', () => {
            console.log('Reconnecting...')
        })
        client.on('connect', () => {
            console.log('Connected to MQTT broker')

            // Berlangganan ke topik tertentu
            const topic = 'testTopic/vol';
            const topic2 = 'testTopic/button';



            client.subscribe(topic, (err) => {
                if (!err) {
                    console.log(`Subscribed to topic: ${topic}`);
                }
            });

            client.subscribe(topic2, (err) => {
                if (!err) {
                    console.log(`Subscribed to topic: ${topic2}`);
                }
            });

        });

        let intervalId1;

        client.on('message', (topic, message) => {
            console.log(`${topic.toString()}`);
            // (`${message.toString()}`);
            if (topic === 'testTopic/button') {
                let on = message.toString();
                if (on == 1) {
                    onStatus.classList.add("bg-[#16FF00]");
                    onStatus.classList.remove("bg-emerald-300");

                    offStatus.classList.add("bg-red-300");
                    offStatus.classList.remove("bg-red-500");
                } else if (on == 0) {
                    onStatus.classList.remove("bg-[#16FF00]");
                    onStatus.classList.add("bg-emerald-300");

                    offStatus.classList.remove("bg-red-300");
                    offStatus.classList.add("bg-red-500");
                }
                resetInterval();
            } else if (topic === 'testTopic/vol') {
                console.log(`${message.toString()}`);
                let percentage = Math.round(message.toString() * 10);
                analogBaterai.innerHTML = ` Baterai : ${percentage} %`;
                // console.log(Math.round(percentage / 25));
                const isiCell = Math.round(percentage / 25);
                if (baterai) {
                    const isiCell = Math.round(percentage / 25); // Adjust this based on your logic

                    // Remove existing cells
                    while (baterai.firstChild) {
                        baterai.removeChild(baterai.firstChild);
                    }

                    // Create and append new cells based on isiCell
                    for (let i = 0; i < isiCell; i++) {
                        const cell = document.createElement("div");
                        cell.className = "w-[22%] h-full bg-green-600";
                        baterai.appendChild(cell);
                    }
                } else {
                    console.error(`Element with ID "${bateraiId}" not found.`);
                }
                // Handle messages for topic2
            }
            resetInterval();
        });


        function handleNoData() {
            console.log('Tidak ada data masuk selama 5 detik. Mati.');
            onStatus.classList.remove("bg-[#16FF00]");
            onStatus.classList.add("bg-emerald-300");

            offStatus.classList.remove("bg-red-300");
            offStatus.classList.add("bg-red-500");
        }

        function resetInterval() {
            clearInterval(intervalId1);
            intervalId1 = setInterval(handleNoData, 5000);
        }

        // Setel interval pertama kali
        resetInterval();
    </script>
@endpush
