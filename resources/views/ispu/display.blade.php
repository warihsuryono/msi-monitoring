<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indeks Standar Pencemar Udara</title>
    <style>
        :root {
            --page: #e9f8f0;
            --ink: #17231d;
            --muted: #5c6c63;
            --line: #8ab9a1;
            --green: #08ad50;
            --blue: #0878bd;
            --yellow: #ffe500;
            --red: #ef3027;
            --black: #111111;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 18px;
            color: var(--ink);
            background: #dcefe4;
            font-family: Arial, Helvetica, sans-serif;
        }

        .dashboard {
            width: min(100%, 980px);
            margin: 0 auto;
            padding: clamp(14px, 2.5vw, 26px);
            overflow: hidden;
            border: 2px solid #a5d4b9;
            border-radius: 22px;
            background:
                radial-gradient(ellipse at 100% 30%, rgba(255, 255, 255, .7), transparent 36%),
                linear-gradient(145deg, #f1fff7 0%, #e4f6ec 55%, #d8eee2 100%);
            box-shadow: 0 12px 36px rgba(27, 73, 48, .12);
        }

        .header {
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: clamp(19px, 3vw, 32px);
            letter-spacing: .11em;
            font-weight: 800;
        }

        .header p {
            margin: 8px 0 18px;
            color: #44594d;
            font-size: clamp(9px, 1.4vw, 13px);
            line-height: 1.5;
            font-weight: 700;
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(130px, .8fr) minmax(185px, 1.15fr) minmax(170px, 1fr);
            gap: 12px;
            align-items: center;
            padding: 16px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 5px 18px rgba(38, 89, 60, .08);
        }

        .quality {
            text-align: center;
        }

        .quality-icon {
            display: grid;
            place-items: center;
            width: 78px;
            height: 78px;
            margin: 0 auto 6px;
            border: 4px solid #e4a6a2;
            border-radius: 50%;
            color: #b64c47;
            background: #fff2f0;
            font-size: 43px;
            font-weight: 700;
        }

        .quality-label {
            color: #9b3f3a;
            font-weight: 800;
            font-size: 13px;
            line-height: 1.3;
        }

        .main-index {
            display: flex;
            min-height: 110px;
            align-items: center;
            justify-content: center;
            gap: 13px;
            padding: 12px;
            border-radius: 28px;
            color: white;
            background: var(--red);
            text-align: center;
        }

        .main-index .number {
            font-size: clamp(38px, 6vw, 58px);
            font-weight: 800;
            line-height: 1;
        }

        .main-index .separator {
            width: 4px;
            height: 72px;
            border-radius: 4px;
            background: rgba(255, 255, 255, .95);
        }

        .main-index .index-label {
            font-size: clamp(16px, 2.5vw, 22px);
            font-weight: 800;
            line-height: 1.35;
        }

        .location {
            padding: 8px 4px;
        }

        .location-name {
            margin-bottom: 8px;
            font-size: clamp(16px, 2.2vw, 22px);
            font-weight: 800;
        }

        .location-name::before {
            content: '📍';
            margin-right: 7px;
        }

        .period {
            color: #4b5b52;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.55;
        }

        .weather {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            width: min(100%, 620px);
            margin: 14px auto;
            padding: 11px 12px;
            border: 2px solid #75b4bd;
            border-radius: 20px;
            background: rgba(255, 255, 255, .7);
            text-align: center;
        }

        .weather-item strong {
            display: block;
            font-size: 13px;
        }

        .weather-item .weather-icon {
            display: block;
            margin: 4px 0;
            font-size: 23px;
        }

        .weather-item .weather-value {
            font-size: 15px;
            font-weight: 800;
        }

        .impact {
            margin: 14px 0 18px;
            padding: 11px 18px;
            border: 2px solid rgba(130, 0, 0, .15);
            border-radius: 17px;
            color: #fff;
            background: var(--red);
            font-size: clamp(13px, 2vw, 20px);
            font-weight: 700;
            line-height: 1.35;
            text-align: center;
        }

        .visualization {
            display: grid;
            grid-template-columns: minmax(145px, 190px) minmax(0, 1fr);
            gap: 16px;
            align-items: stretch;
        }

        .legend-left {
            display: flex;
            flex-direction: column;
        }

        .legend-left h3 {
            display: grid;
            place-items: center;
            min-height: 47px;
            margin: 0;
            color: white;
            background: #080808;
            font-size: 15px;
        }

        .legend-left .legend-band {
            display: grid;
            flex: 1;
            min-height: 39px;
            place-items: center;
            border: 1px solid rgba(0, 0, 0, .7);
            font-size: 14px;
            font-weight: 800;
        }

        .legend-left .good {
            color: white;
            background: var(--green);
        }

        .legend-left .moderate {
            color: white;
            background: var(--blue);
        }

        .legend-left .unhealthy {
            color: #161616;
            background: var(--yellow);
        }

        .legend-left .very-unhealthy {
            color: white;
            background: var(--red);
        }

        .legend-left .hazardous {
            color: white;
            background: var(--black);
        }

        .bars-wrap {
            min-width: 0;
        }

        .bars {
            display: grid;
            grid-template-columns: repeat(7, minmax(38px, 1fr));
            gap: clamp(5px, 1.5vw, 13px);
            height: 260px;
            padding: 0 4px;
            align-items: stretch;
        }

        .bar-column {
            position: relative;
            min-width: 0;
            height: 90%;
        }

        .bar-track {
            position: absolute;
            inset: 0 0 0;
            overflow: hidden;
            border-radius: 12px;
            background: #dfe3e1;
        }

        .bar-fill {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            min-height: 0;
            border-radius: 10px 10px 0 0;
            transition: height .5s ease, background-color .3s ease;
        }

        .bar-value {
            position: absolute;
            z-index: 2;
            right: 0;
            bottom: calc(var(--bar-height) + 7px);
            left: 0;
            overflow: visible;
            color: #26332b;
            font-size: 13px;
            font-weight: 800;
            text-align: center;
            text-shadow: 0 1px 2px rgba(255, 255, 255, .8);
        }

        .bar-label {
            margin-top: 267px;
            color: #28372e;
            font-size: clamp(10px, 1.4vw, 13px);
            font-weight: 800;
            text-align: center;
            white-space: nowrap;
        }

        .legend-bottom {
            width: min(100%, 760px);
            margin: 38px auto 0;
            padding: 9px 13px 12px;
            border: 2px solid #78ad91;
            border-radius: 21px;
            background: rgba(255, 255, 255, .55);
        }

        .legend-bottom h3 {
            margin: 0 0 9px;
            font-size: 15px;
            text-align: center;
        }

        .legend-scale {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            overflow: hidden;
            border: 1px solid #71947f;
        }

        .legend-scale span {
            padding: 11px 4px;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
        }

        .legend-scale .good {
            color: white;
            background: var(--green);
        }

        .legend-scale .moderate {
            color: white;
            background: var(--blue);
        }

        .legend-scale .unhealthy {
            color: #171717;
            background: var(--yellow);
        }

        .legend-scale .very-unhealthy {
            color: white;
            background: var(--red);
        }

        .legend-scale .hazardous {
            color: white;
            background: var(--black);
        }

        .footer {
            margin-top: 15px;
            color: #4e6255;
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }

        .footer .updated {
            display: block;
            margin-top: 5px;
            color: #718177;
        }

        @media (max-width: 650px) {
            body {
                padding: 7px;
            }

            .dashboard {
                padding: 12px 9px;
                border-radius: 15px;
            }

            .hero {
                grid-template-columns: 1fr 1.2fr;
                padding: 11px;
            }

            .quality {
                grid-row: span 1;
            }

            .location {
                grid-column: 1 / -1;
                text-align: center;
            }

            .main-index {
                min-height: 92px;
                border-radius: 20px;
            }

            .main-index .separator {
                height: 56px;
            }

            .visualization {
                grid-template-columns: 104px minmax(0, 1fr);
                gap: 7px;
            }

            .legend-left h3 {
                font-size: 11px;
            }

            .legend-left .legend-band {
                font-size: 10px;
            }

            .bars {
                height: 205px;
                gap: 4px;
                padding: 0;
            }

            .bar-label {
                margin-top: 212px;
                font-size: 9px;
            }

            .bar-value {
                font-size: 10px;
            }

            .legend-bottom {
                margin-top: 34px;
                padding: 8px 7px;
            }

            .legend-scale span {
                padding: 8px 2px;
                font-size: 9px;
            }

            .weather {
                gap: 2px;
                padding: 9px 4px;
            }

            .weather-item strong {
                font-size: 10px;
            }

            .weather-item .weather-value {
                font-size: 12px;
            }

            .period {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header class="header">
            <h1>INDEKS STANDAR PENCEMAR UDARA (ISPU)</h1>
            <p>ACUAN: PERATURAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA<br>
                NOMOR P.14/MENLHK/SETJEN/KUM.1/7/2020 TENTANG INDEKS STANDAR PENCEMAR UDARA</p>
        </header>

        <section class="hero">
            <div class="quality">
                <div class="quality-icon" id="statusIcon" aria-hidden="true">{{ $data['statusIcon'] }}</div>
                <div class="quality-label" id="statusTitle">{{ $data['statusTitle'] }}</div>
            </div>
            <div class="main-index" id="mainIndex" style="background: {{ $data['categoryColor'] }}">
                <div class="number" id="mainValue">{{ $data['mainValue'] }}</div>
                <div class="separator"></div>
                <div class="index-label">ISPU<br><span id="mainParameter">{{ $data['mainParameter'] }}</span></div>
            </div>
            <div class="location">
                <div class="location-name" id="locationName">{{ $data['location'] }}</div>
                <div class="period">
                    <span id="startAt">{{ $data['startAt'] ?? '-' }}</span> s/d<br>
                    <span id="endAt">{{ $data['endAt'] ?? '-' }}</span> WIB
                </div>
            </div>
        </section>

        <section class="weather" aria-label="Informasi meteorologi">
            <div class="weather-item"><strong>Kelembapan</strong><span class="weather-icon">💧</span><span
                    class="weather-value" id="humidity">{{ $data['weather']['humidity'] ?? '-' }} %</span></div>
            <div class="weather-item"><strong>Tekanan Udara</strong><span class="weather-icon">🌬</span><span
                    class="weather-value" id="pressure">{{ $data['weather']['pressure'] ?? '-' }} mBar</span></div>
            <div class="weather-item"><strong>Suhu</strong><span class="weather-icon">🌡</span><span
                    class="weather-value" id="temperature">{{ $data['weather']['temperature'] ?? '-' }} °C</span></div>
        </section>

        <div class="impact" id="impactText">{{ $data['impactText'] }}</div>

        <section class="visualization">
            <div class="legend-left" aria-label="Keterangan kategori ISPU">
                <div class="legend-band hazardous">Berbahaya</div>
                <div class="legend-band very-unhealthy">Sangat Tidak Sehat</div>
                <div class="legend-band unhealthy">Tidak Sehat</div>
                <div class="legend-band moderate">Sedang</div>
                <div class="legend-band good">Baik</div>
            </div>

            <div class="bars-wrap">
                <div class="bars">
                    @foreach ($data['parameters'] as $key => $parameter)
                        <div class="bar-column">
                            <div class="bar-track">
                                <div class="bar-fill" id="bar-{{ $key }}"
                                    style="height: {{ $parameter['height'] }}%; background: {{ $parameter['color'] }}">
                                </div>
                            </div>
                            <div class="bar-value" id="value-{{ $key }}"
                                style="--bar-height: {{ $parameter['height'] }}%">{{ $parameter['display'] }}</div>
                            <div class="bar-label">{{ $parameter['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="legend-bottom">
            <h3>Kategori Indeks Standar Pencemar Udara</h3>
            <div class="legend-scale">
                <span class="good">1–50</span>
                <span class="moderate">51–100</span>
                <span class="unhealthy">101–200</span>
                <span class="very-unhealthy">201–300</span>
                <span class="hazardous">≥ 301</span>
            </div>
        </section>

        <footer class="footer">
            Pengukuran Indeks Standar Pencemar Udara (ISPU) dilakukan dengan menggunakan alat AQMS (Air Quality
            Monitoring System) dan dilakukan pengukuran rata-rata 24 jam
        </footer>
    </div>

    <script>
        (() => {
            const dataUrl = @json(route('display.ispu.data', ['deviceId' => $deviceId]));
            const parameterKeys = ['pm10', 'pm25', 'so2', 'co', 'o3', 'no2', 'hc'];

            function setText(id, value) {
                const element = document.getElementById(id);
                if (element) element.textContent = value ?? '-';
            }

            function applyData(data) {
                setText('mainValue', data.mainValue);
                setText('mainParameter', data.mainParameter);
                setText('statusTitle', data.statusTitle);
                setText('statusIcon', data.statusIcon);
                setText('impactText', data.impactText);
                setText('locationName', data.location);
                setText('startAt', data.startAt);
                setText('endAt', data.endAt);
                setText('updatedAt', data.updatedAt);

                const mainIndex = document.getElementById('mainIndex');
                if (mainIndex) mainIndex.style.backgroundColor = data.categoryColor;

                parameterKeys.forEach((key) => {
                    const parameter = data.parameters?.[key];
                    if (!parameter) return;
                    const fill = document.getElementById(`bar-${key}`);
                    const value = document.getElementById(`value-${key}`);
                    if (fill) {
                        fill.style.height = `${parameter.height}%`;
                        fill.style.backgroundColor = parameter.color;
                    }
                    if (value) {
                        value.textContent = parameter.display;
                        value.style.setProperty('--bar-height', `${parameter.height}%`);
                    }
                });
            }

            async function refreshIspu() {
                try {
                    const response = await fetch(dataUrl, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        cache: 'no-store'
                    });
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);
                    applyData(await response.json());
                } catch (error) {
                    console.warn('Gagal memperbarui data ISPU:', error);
                }
            }

            window.setInterval(refreshIspu, {{ $refreshSeconds * 1000 }});
        })();
    </script>
</body>

</html>
