@include('partials.top')
@include('navbar')
<div class="container">
    
    <a href="{{ route('rules.index')}}" style="padding: 5px; border-radius: 5px; border: 1px solid darkgray;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg>
        Torna indietro
    </a>

    <div class="row">

        <h4 style="margin-top: 10px;">Nuova regola</h4><br>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0a3622" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/></svg>
                <strong>Operazione completata</strong><br>
                Regola inserita correttamente
            </div>
        @endif

        @if (session('found'))
            <div class="alert alert-warning" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#664D03" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
                <strong>Attenzione!</strong><br>
                Regola <strong>non</strong> inserita: è stato trovato un accavallamento di orari
            </div>
        @endif

        @if (session('notImplementedYet'))
            <div class="alert alert-warning" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#664D03" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
                <strong>Attenzione!</strong><br>
                Funzione non ancora implementata
            </div>
        @endif
        
        <div class="col" style="margin-top: 20px;">

            <form action="{{ route('rules.store') }}"style="display: flex; flex-direction: column;">
                Servizio
                <select name="service" id="service">
                    <option value="">-- Seleziona un servizio --</option>
                    @foreach ($servicesPrincipali as $service)
                        <option value="{{ $service->servizio }}">{{ $service->servizio }}</option>                        
                    @endforeach
                </select><br>

                Flag
                <select name="flag" id="flag" onchange="showDates()">
                    <option value="ALL">ALL</option>
                    <option value="SABATO">SABATO</option>
                    <option value="DOMENICA">DOMENICA</option>
                    <option value="GIORNO">GIORNO</option>
                </select><br>

                <span id="dates">
                Data iniziale
                <input type="date" id="startDate" name="startDate"><br>

                Data finale
                <input type="date" id="endDate" name="endDate"><br>
                </span>

                Ora iniziale:
                <span style="display: flex; flex-direction: row;">
                    <select name="startHour" id="startHour" style="margin-right: 5px;">
                        <option value="1">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select> 
                    :
                    <select name="startMinute" id="startMinute" style="margin-left: 5px;">
                        <option value="1">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select><br>
                </span><br>

                Ora finale:
                <span style="display: flex; flex-direction: row;">
                    <select name="endHour" id="endHour" style="margin-right: 5px;">
                        <option value="1">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select> 
                    :
                    <select name="endMinute" id="endMinute" style="margin-left: 5px;">
                        <option value="1">00</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                    </select><br>
                </span><br>

                Coppia prima coda
                <select name="firstQueuePair" id="firstQueuePair" onchange="equalPartitions()">
                    <option value="">-- Seleziona un sotto-servizio --</option>
                    @foreach ($servicesPartizionati as $partService)
                        <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                            {{ $partService->servizio }}
                        </option>
                    @endforeach
                </select>

                Partizione prima coda
                <input type="number" id="firstPartition" max="100" oninput="equalPartitions()"><br>

                Coppia seconda coda
                <select name="secondQueuePair" id="secondQueuePair" onchange="equalPartitions()">
                    <option value="">-- Seleziona un sotto-servizio --</option>
                    @foreach ($servicesPartizionati as $partService)
                        <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                            {{ $partService->servizio }}
                        </option>
                    @endforeach
                </select>

                Partizione seconda coda
                <input type="number" id="secondPartition" max="100" oninput="equalPartitions()"><br>

                Coppia terza coda
                <select name="thirdQueuePair" id="thirdQueuePair" onchange="equalPartitions()">
                    <option value="">-- Seleziona un sotto-servizio --</option>
                    @foreach ($servicesPartizionati as $partService)
                        <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                            {{ $partService->servizio }}
                        </option>
                    @endforeach
                </select><br>

                Partizione terza coda
                <input type="number" id="thirdPartition" max="100" oninput="equalPartitions()"><br>

                <button type="submit" id="submitButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                    Salva
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        margin-top: 50px;
    }

    .row {
        text-align: center;
    }
    
    .col {
        text-align: left;
        display: flex;
        /* flex-direction: column; */
        justify-content: center;
    }
    
    form {
        background-color: whitesmoke;
        padding: 20px;
        border-radius: 10px;
    }

    input[type="text"], select {
        height: 40px;
    }

    button[type="submit"] {
        border: 1px solid lightgray;
        color: black;
        background-color: white;
        border-radius: 35px;
        height: 50px;
    }

    button[type="submit"]:hover {
        outline: 1px solid lightgray;
        background-color: #5cb85c;
        color: white;
    }

    a {
        text-decoration: none;
        border: 1px solid darkgray;
        padding: 5px;
    }

    #dates {
        display: none;
    }
</style>

<script>
// Data dinamica ad oggi per gli input date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDate').setAttribute('min', today);
    document.getElementById('endDate').setAttribute('min', today);
// Viene inserito solo il servizio di tipo partizione per la seconda e terza
// dropdown
document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.getElementById('service');

        // const firstSelect = document.getElementById('firstQueuePair');
        const secondSelect = document.getElementById('secondQueuePair');
        const thirdSelect = document.getElementById('thirdQueuePair');

        // const allFirstOptions = Array.from(firstSelect.options);
        const allSecondOptions = Array.from(secondSelect.options);
        const allThirdOptions = Array.from(thirdSelect.options);

        function filterOptions(selectElement, allOptions, selectedPrefix) {
            // Reset
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = '-- Seleziona un sotto-servizio --';
            selectElement.appendChild(defaultOption);

            // Filtra e aggiungi
            const filtered = allOptions.filter(option => {
                const prefix = option.getAttribute('data-prefix');
                return prefix && prefix.startsWith(selectedPrefix);
            });

            filtered.forEach(option => selectElement.appendChild(option));
        }

        serviceSelect.addEventListener('change', function () {
            const selectedPrefix = this.value;

            // filterOptions(firstSelect, allFirstOptions, selectedPrefix);
            filterOptions(secondSelect, allSecondOptions, selectedPrefix);
            filterOptions(thirdSelect, allThirdOptions, selectedPrefix);
        });
    });

// Funzione che attiva le date se il FLAG selezionato è GIORNO
function showDates(){

    var selectedFlag = document.getElementById("flag").value;

    if ( selectedFlag === "GIORNO" ) {
        document.getElementById("dates").style.display = "flex";
        document.getElementById("dates").style.flexDirection = "column";
    } else {
        document.getElementById("dates").style.display = "none";
    }
}

// Disabilitazione input

document.getElementById("firstPartition").disabled = true;
document.getElementById("secondPartition").disabled = true;
document.getElementById("thirdPartition").disabled = true;

document.getElementById("submitButton").style.display = "none";


// Funzione che gestisce le ripartizioni di percentuali
function equalPartitions() {

    // Se la prima coppia di code non è vuota, ma le altre due sì
    if ( document.getElementById("firstQueuePair").value != "" ) {

        // Disattiva le altre due
        document.getElementById("firstPartition").disabled = false;
        document.getElementById("secondPartition").disabled = true;
        document.getElementById("thirdPartition").disabled = true;

        if ( document.getElementById("firstPartition").value == 100 ) {
            
            document.getElementById("secondQueuePair").disabled = true;
            document.getElementById("thirdQueuePair").disabled = true;
            
            document.getElementById("secondPartition").disabled = true;
            document.getElementById("thirdPartition").disabled = true;

            document.getElementById("secondQueuePair").value = "";
            document.getElementById("thirdQueuePair").value = "";
            
            document.getElementById("secondPartition").value = "";
            document.getElementById("thirdPartition").value = "";

            document.getElementById("submitButton").style.display = "block";
        } else {
            document.getElementById("secondQueuePair").disabled = false;
            document.getElementById("thirdQueuePair").disabled = false;
            
            document.getElementById("secondPartition").disabled = false;
            document.getElementById("thirdPartition").disabled = false;
        }
    // Se le prime due non sono vuote, ma l'ultima sì
    }

    if ( document.getElementById("firstQueuePair").value != "" && document.getElementById("secondQueuePair").value != "" ) {
        
        document.getElementById("thirdPartition").disabled = true;

        if ( Number(document.getElementById("firstPartition").value) + Number(document.getElementById("secondPartition").value) == 100 ) { 
            document.getElementById("thirdQueuePair").disabled = true;
            document.getElementById("thirdPartition").disabled = true;

            document.getElementById("thirdQueuePair").value = "";
            document.getElementById("thirdPartition").value = "";

            document.getElementById("submitButton").style.display = "block";
        }
    }

    if ( document.getElementById("firstQueuePair").value != "" && document.getElementById("secondQueuePair").value != "" && document.getElementById("thirdQueuePair").value != "" ) {
        document.getElementById("thirdPartition").disabled = false;
        document.getElementById("submitButton").style.display = "none";

        if ( Number(document.getElementById("firstPartition").value) + Number(document.getElementById("secondPartition").value) + Number(document.getElementById("thirdPartition").value) == 100 ) {
            document.getElementById("submitButton").style.display = "block";
        }
    }

}
</script>
@include('partials.bottom')