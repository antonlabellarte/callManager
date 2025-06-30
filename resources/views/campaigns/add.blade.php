@include('partials.top')
@include('navbar')

<div class="container" style="margin-top: 10px;">
    <h3 style="color: white; -webkit-text-stroke: 1px black;">Nuova campagna</h3>
    <div class="row">
        <div class="col" action="">
            <form action="{{ route('campaigns.store') }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label>Nome campagna</label>
                    <input type="text" class="form-control" id="nomeCampagna" name="nomeCampagna">
                </div>
                <div class="mb-3">
                    <label>Messaggio</label>
                    <textarea class="form-control" id="testo" name="testo" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label>Tutti i chiamanti</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="allCustomer" id="allCustomer1" value="1" onchange="hideGroups()">
                        <label class="form-check-label" for="allCustomer1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="allCustomer" id="allCustomer2" value="0" onchange="hideGroups()">
                        <label class="form-check-label" for="allCustomer2">
                            No
                        </label>
                    </div>

                    <label>Abbattimento</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abbattimento" id="abbattimento1" value="1" onchange="hideGroups()">
                        <label class="form-check-label" for="abbattimento1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abbattimento" id="abbattimento2" value="0" onchange="hideGroups()">
                        <label class="form-check-label" for="abbattimento2">
                            No
                        </label>
                    </div>

                    <label>Attiva</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enabled" id="enabled1" value="1" onchange="hideGroups()">
                        <label class="form-check-label" for="enabled1">
                            Sì
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enabled" id="enabled2" value="0" onchange="hideGroups()">
                        <label class="form-check-label" for="enabled2">
                            No
                        </label>
                    </div>
                </div>
                <div class="mb-3" id="startDateGroup">
                    <label>Data iniziale</label>
                    <input type="date" class="form-control" id="dataInizio" name="dataInizio">
                    <label style="margin-top: 10px;">Ora iniziale</label>
                    <select name="startHour" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
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
                    <select name="startMinute" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
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
                <div class="mb-3" id="endDateGroup">
                    <label>Data finale</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                    <label style="margin-top: 10px;">Ora finale</label>
                    <select name="endHour" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
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
                    <select name="endMinute" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
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
                        <option>1000</option>
                    </select>
                </div>
                <div class="mb-3" id="forceQueueGroup">
                    <label style="margin-top: 10px; width: 200px;">Forza su coda</label>
                    <select name="forzaCoda" id="forzaCoda" style="border: 1px solid lightgray; background-color: white; border-radius: 10px;">
                        <option>1000</option>
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
                            Reimposta campi
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
    function hideGroups() {
        const checkboxAllCustomer = document.getElementById('switchCheckDefault').value;
        const checkboxAbbattimento = document.getElementById('switchCheckDefault').value;
        const checkboxEnabled = document.getElementById('switchCheckDefault').value;

        if( checkboxAllCustomer == 1 ) {
            console.log("è 1")
        }
    }
</script>