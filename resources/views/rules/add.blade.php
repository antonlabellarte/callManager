@include('partials.top')
@include('navbar')
<div class="container">
    <div class="alert alert-light" role="alert" style="margin-top: 20px; border-color: black; color: black;">
        Nuova regola
    </div>
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <span style="float: right;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0a3622" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/></svg>
                <strong>Operazione completata</strong><br>
                Regola inserita correttamente
            </div>
        @endif

        @if (session('overlapFoundNoDates') || session('overlapFoundWithDates'))
            <div class="alert alert-warning" role="alert">
                <span style="float: right;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#664D03" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
                <strong>Attenzione!</strong><br>
                Regola <strong>non</strong> inserita: è stato trovato un accavallamento di orari
            </div>
        @endif
        
        <div class="col" style="margin-top: 20px;">
            <form action="{{ route('rules.store') }}">
                <!-- Servizio -->
                <div class="form-group">
                    <label>Servizio</label>
                    <select class="form-control" name="service" id="service">
                        <option value="">-- Seleziona un servizio --</option>
                        @foreach ($servicesPrincipali as $service)
                            <option value="{{ $service->name }}">{{ $service->name }}</option>
                        @endforeach
                    </select><br>
                </div>

                <div class="form-group">
                    <label>Flag</label>
                    <select class="form-control" name="flag" id="flag" onchange="disableDates()">
                        <option value="">-- Seleziona un flag --</option>
                        <option value="ALL">ALL</option>
                        <option value="SABATO">SABATO</option>
                        <option value="DOMENICA">DOMENICA</option>
                        <option value="GIORNO">GIORNO</option>
                    </select><br>
                </div>

                <div class="form-group" id="startDateGroup">
                    <label>Data iniziale</label>
                    <input class="form-control" type="date" id="startDate" name="startDate" disabled>                    
                </div><br>

                <div class="form-group" id="endDateGroup">
                    <label>Data finale</label>
                    <input class="form-control" type="date" id="endDate" name="endDate" disabled>
                </div><br>

                <div class="form-group">
                    <label style="width: 100px; text-align: left;">Ora iniziale:</label>
                    <input type="time" name="startTime" id="startTime"><br>

                    <label style="width: 100px; text-align: left;">Ora finale:</label>
                    <input type="time" name="endTime" id="endTime"><br>
                </div>

                <div class="form-group">
                    Coppia prima coda
                    <select class="form-control" name="firstQueuePair" id="firstQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->name }}" data-prefix="{{ Str::substr($partService->name, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->name }}
                            </option>
                        @endforeach
                    </select>

                    Partizione prima coda
                    <input type="number" class="form-control" name="firstPartition" id="firstPartition" max="100" oninput="equalPartitions()"><br>
                </div><br>

                <div class="form-group">
                    Coppia seconda coda
                    <select class="form-control" name="secondQueuePair" id="secondQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->name }}" data-prefix="{{ Str::substr($partService->name, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->name }}
                            </option>
                        @endforeach
                    </select>

                    Partizione seconda coda
                    <input type="number" class="form-control" name="secondPartition" id="secondPartition" max="100" oninput="equalPartitions()"><br>
                </div>

                <div class="form-group">
                    Coppia terza coda
                    <select class="form-control" name="thirdQueuePair" id="thirdQueuePair" onchange="equalPartitions()">
                        <option value="">-- Seleziona un sotto-servizio --</option>
                        @foreach ($servicesPartizionati as $partService)
                            <option value="{{ $partService->name }}" data-prefix="{{ Str::substr($partService->name, 0, strlen($servicesPrincipali[0]->servizio)) }}">
                                {{ $partService->name }}
                            </option>
                        @endforeach
                    </select><br>

                    Partizione terza coda
                    <input type="number" class="form-control" name="thirdPartition" id="thirdPartition" max="100" oninput="equalPartitions()"><br>
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
                            Reset
                        <span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        text-align: center;
    }

    .col{
        text-align: left;
        display: flex;
        justify-content: center;
    }

    form {
        display: flex;
        flex-direction: column;
        text-align: left;
        width: 65%;
        background-color: whitesmoke;
        border: 1px solid lightgray;
        border-radius: 10px;
        padding: 20px;
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

    input[type="time"] {
        border: 1px solid darkgray;
        padding: 5px;
        border-radius: 5px;
    }

    @media only screen and (max-width: 767px) and (orientation: portrait) {
        form {
            width: 100%;
        }
    }
</style>

<script>
// Se flag diverso da giorno disabilita le date
function disableDates(){
    let flag = document.getElementById('flag').value

    if (flag !== "GIORNO") {
        document.getElementById('startDate').value = "";
        document.getElementById('endDate').value = "";
        document.getElementById('startDate').disabled = true;
        document.getElementById('endDate').disabled = true;
    } else {
        document.getElementById('startDate').disabled = false;
        document.getElementById('endDate').disabled = false;
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
