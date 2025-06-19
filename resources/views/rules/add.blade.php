@include('partials.top')
@include('navbar')
<div class="container">
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
            <form action="{{ route('rules.store') }}" style="display: flex; flex-direction: column;">
                <!-- Servizio -->
                <div class="form-group">
                    <label>Servizio</label>
                    <select class="form-control" name="service" id="service">
                        <option value="">-- Seleziona un servizio --</option>
                        @foreach ($servicesPrincipali as $service)
                            <option value="{{ $service->servizio }}">{{ $service->servizio }}</option>                        
                        @endforeach
                    </select><br>
                </div>

                <div class="form-group">
                    <label>Flag</label>
                    <select class="form-control" name="flag" id="flag" onchange="showDates()">
                        <option value="ALL">ALL</option>
                        <option value="SABATO">SABATO</option>
                        <option value="DOMENICA">DOMENICA</option>
                        <option value="GIORNO">GIORNO</option>
                    </select><br>
                </div>

                <div class="form-group" id="startDateGroup">
                    <label>Data iniziale</label>
                    <input class="form-control" type="date" id="startDate" name="startDate">                    
                </div><br>

                <div class="form-group" id="endDateGroup">
                    <label>Data finale</label>
                    <input class="form-control" type="date" id="endDate" name="endDate">
                </div><br>

                <div class="form-group">
                    <span style="width: 100px;">Ora iniziale:</span>
                    <select name="startHour" id="startHour">
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
                    <select name="startMinute" id="startMinute">
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

                    <span style="width: 100px;">Ora finale:</span>
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
                    </select>
                </div>

                <div class="form-group">
                    Coppia prima coda
                    <select class="form-control" name="firstQueuePair" id="firstQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->servizio }}
                            </option>
                        @endforeach
                    </select>

                    Partizione prima coda
                    <input type="number" class="form-control" id="firstPartition" max="100" oninput="equalPartitions()"><br>
                </div><br>

                <div class="form-group">
                    Coppia seconda coda
                    <select class="form-control" name="secondQueuePair" id="secondQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->servizio }}
                            </option>
                        @endforeach
                    </select>

                    Partizione seconda coda
                    <input type="number" class="form-control" id="secondPartition" max="100" oninput="equalPartitions()"><br>
                </div>

                <div class="form-group">
                    Coppia terza coda
                    <select class="form-control" name="thirdQueuePair" id="thirdQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->servizio }}" data-prefix="{{ Str::substr($partService->servizio, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->servizio }}
                            </option>
                        @endforeach
                    </select><br>

                    Partizione terza coda
                    <input type="number" class="form-control" id="thirdPartition" max="100" oninput="equalPartitions()"><br>
                </div>
                <button type="submit" class="defaultBtn" id="submitButton">Salva</button>
                <button type="reset" class="defaultBtn" style="margin-top: 10px">Reset</button>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        margin: 0 auto;
    }

    .col{
        border: 1px solid lightgray;
        background-color: white;
        padding: 10px;
        display: flex;
        justify-content: center;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 30%;
    }

    #startDateGroup, #endDateGroup {
        display: none;
    }

    #startMinute, #startHour, #endMinute, #endHour {
        margin-top: 5px;
        border-radius: 0.375rem;
        border-color: #dee2e6;
        padding: 5px;
    }

    button[type="submit"], button[type="reset"] {
        height: 40px;
    }
</style>

<script>
// Funzione che attiva le date se il FLAG selezionato è GIORNO
function showDates(){

    if( document.getElementById("flag").value === "GIORNO" ){
        document.getElementById("startDateGroup").style.display = "block";
        document.getElementById("endDateGroup").style.display = "block";

    } else {
        document.getElementById("startDateGroup").style.display = "none";
        document.getElementById("endDateGroup").style.display = "none";
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
