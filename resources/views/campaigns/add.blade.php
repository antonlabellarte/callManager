@include('partials.top')
@include('navbar')

<div class="container" style="margin-top: 10px;">
    <div class="alert alert-light" role="alert" style="margin-top: 20px; border-color: black; color: black;">
        Nuova campagna
    </div>

    <div class="alert alert-danger" id="validationAlert" role="alert" style="width: fit-content; margin: 0 auto; margin-bottom: 15px; display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
        <span id="validationAlertText"></span>
    </div>

    @if (session('overlapFound') || session('warning'))
        <div class="alert alert-danger" role="alert" style="width: fit-content; margin: 0 auto; margin-bottom: 15px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
            <span>
                @if (session('warning'))
                    {{ session('warning') }}
                @endif
                @if (session('overlapFound'))
                    {{ session('overlapFound') }}<br>
                    @foreach(session('overlap') as $campaign)
                        <li>{{ $campaign->name }}</li>
                    @endforeach
                @endif
            </span>
        </div>
    @endif
    <div class="row">
        <div class="col" action="">
            <form action="{{ route('campaigns.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf
                <div class="mb-3">
                    <label id="campaignNameLabel">Nome campagna</label>
                    <input type="text" class="form-control" id="nomeCampagna" name="nomeCampagna" oninput="checkEmptiness()">
                </div>
                <div class="mb-3">
                    <label>Messaggio</label>
                    <textarea class="form-control" id="testo" name="testo" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label id="allCustomerLabel">Tutti i chiamanti</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="allCustomer" id="allCustomer1" value="1" onchange="checkEmptiness()">
                        <label class="form-check-label" for="allCustomer1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="allCustomer" id="allCustomer2" value="0" onchange="checkEmptiness()">
                        <label class="form-check-label" for="allCustomer2">
                            No
                        </label>
                    </div>

                    <label id="abbattimentoLabel">Abbattimento</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abbattimento" id="abbattimento1" value="1" onchange="checkEmptiness()">
                        <label class="form-check-label" for="abbattimento1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abbattimento" id="abbattimento2" value="0" onchange="checkEmptiness()">
                        <label class="form-check-label" for="abbattimento2">
                            No
                        </label>
                    </div>

                    <label id="enabledLabel">Attiva</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enabled" id="enabled1" value="1" onchange="checkEmptiness()">
                        <label class="form-check-label" for="enabled1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enabled" id="enabled2" value="0" onchange="checkEmptiness()">
                        <label class="form-check-label" for="enabled2">
                            No
                        </label>
                    </div>
                </div>
                <div class="mb-3" id="startDateGroup">
                    <label>Data iniziale</label>
                    <input type="date" class="form-control" id="dataInizio" name="dataInizio">
                    <label style="margin-top: 10px;">Ora iniziale</label>
                    <input type="time" name="startTime" id="startTime">
                </div>
                <div class="mb-3" id="endDateGroup">
                    <label>Data finale</label>
                    <input type="date" class="form-control" id="endDate" name="dataFine">
                    <label style="margin-top: 10px;">Ora finale</label>
                    <input type="time" name="endTime" id="endTime">
                    : 
                    <select name="endMinute" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
                        <option value=""></option>
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
                <div class="mb-3" id="queueGroup">
                    <label style="margin-top: 10px; width: 200px;">Coda di destinazione</label>
                    <select name="queue" id="queue" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
                            <option value=""></option>
                        @foreach($queues as $queue)
                            <option value="{{ $queue->queue }}">{{ $queue->queue }} | {{ $queue->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="forceQueueGroup">
                    <label style="margin-top: 10px; width: 200px;">Forza su coda</label>
                    <select name="forzaCoda" id="forzaCoda" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
                        <option value=""></option>
                        @foreach($queues as $queue)
                            <option value="{{ $queue->queue }}">{{ $queue->queue }} | {{ $queue->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" style="display: flex; flex-direction: row;">
                    <button type="submit" style="width: 60%; margin-right: 10px;">
                        <span style="float: left;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                        </span>
                        <span style="float: center;">
                            Salva
                        </span>
                    </button>
                    <button type="reset" style="width: 60%;">
                        <span style="float: left;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                        </span>
                        <span style="float: center;">
                            Reset campi
                        <span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.bottom')

<style>
    .container {
        text-align: center;
    }
    .col {
        text-align: left;
        display: flex;
        justify-content: center;
    }

    form {
        width: 60%;
        background-color: whitesmoke;
        border: 1px solid lightgray;
        border-radius: 10px;
        padding: 20px;
    }

    button[type="submit"], button[type="reset"] {
        height: 40px;
        border: 1px solid lightgray;
        background-color: white;
        color: black;
    }

    button[type="submit"]:hover, button[type="reset"]:hover,
    button[type="submit"]:focus, button[type="reset"]:focus {
        border: 1px solid lightgray;
        background-color: #5F57A1;
        color: white;
    }

    @media (max-width: 767px) {
        form {
            width: 100%;
        }
    }
</style>

<script>
    // Selezione preliminare delle label e radio button
    let campaignNameLabel = document.getElementById('campaignNameLabel');
    let allCustomerLabel = document.getElementById('allCustomerLabel');
    let abbattimentoLabel = document.getElementById('abbattimentoLabel');
    let enabledLabel = document.getElementById('enabledLabel');
    
    // Imposta le label rosse di default
    campaignNameLabel.style.color = "red";
    allCustomerLabel.style.color = "red";
    abbattimentoLabel.style.color = "red";
    enabledLabel.style.color = "red";

    // Se le radio non sono checkate diventano rosse
    if ( !document.querySelector('input[name="allCustomer"]:checked') ) {
            allCustomerLabel.style.color = "red";
    }

    if ( !document.querySelector('input[name="abbattimento"]:checked') ) {
            abbattimentoLabel.style.color = "red";
    }

    if ( !document.querySelector('input[name="enabled"]:checked') ) {
            enabledLabel.style.color = "red";
    }   

    // Funzione di controllo dei dati vuoti
    function checkEmptiness() {
        let campaignName = document.getElementById('nomeCampagna').value;

        if (campaignName !== "") {
            campaignNameLabel.style.color = "black";
        } else {
            campaignNameLabel.style.color = "red";
        }

        if ( document.querySelector('input[name="allCustomer"]:checked') ) {
            allCustomerLabel.style.color = "black";
        }

        if ( document.querySelector('input[name="abbattimento"]:checked') ) {
            abbattimentoLabel.style.color = "black";
        }

        if ( document.querySelector('input[name="enabled"]:checked') ) {
            enabledLabel.style.color = "black";
        }
    }

    // Funzione di validazione forme
    function validateForm() {
        let validationAlert = document.getElementById('validationAlert');
        

        let campaignName = document.getElementById('nomeCampagna').value;

        if ( campaignName == "" ) {
            document.getElementById('validationAlertText').innerHTML = "Nome campagna obbligatorio"
            validationAlert.style.display = "block";
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false
        } else if ( !document.querySelector('input[name="allCustomer"]:checked') ) {
            document.getElementById('validationAlertText').innerHTML = "Specificare se la campagna è per tutti  i chiamanti"
            validationAlert.style.display = "block";
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false
        } else if ( !document.querySelector('input[name="abbattimento"]:checked') )  {
            document.getElementById('validationAlertText').innerHTML = "Specificare se l'abbattimento dev'essere attivato"
            validationAlert.style.display = "block";
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false
        } else if ( !document.querySelector('input[name="enabled"]:checked') ) {
            document.getElementById('validationAlertText').innerHTML = "Specificare se dev'essere attivata"
            validationAlert.style.display = "block";
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false;
        } else {
            return true;
        }
    }
</script>