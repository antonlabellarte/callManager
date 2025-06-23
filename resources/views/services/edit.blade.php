@include('partials.top')
@include('navbar')

{{-- <div class="container">
    <div class="row">
        <h3 style="margin-top: 20px;">Modifica coda ID: # {{ $queue->id }}</h3><br>
        @if (session('updated'))
            <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto;">
                <span style="float: left;">
                    Coda aggiornata
                </span>
                <span style="float: right;">
                    <button onclick="closeAlert()" style="border: transparent; background-color: transparent;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                    </button>
                </span>
            </div><br>
        @endif
        <div class="col" style="margin-top: 10px;">
            <form action="{{ route('queues.update', $queue->id) }}" method="POST">
                @csrf
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Servizio</label>
                    <input type="text" class="form-control" name="service" id="service" value="{{ $queue->servizio }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Coda</label>
                    <input type="number" class="form-control" name="queue" id="queue" value="{{ $queue->coda }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tipologia</label>
                    <select class="form-select" name="tipology" id="tipology">
                        <option value=""></option>
                        <option value="principale" {{ $queue->tipologia == 'principale' ? 'selected' : '' }}>Principale</option>
                        <option value="secondaria" {{ $queue->tipologia == 'secondaria' ? 'selected' : '' }}>Secondaria</option>
                    </select>

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Specializzazione</label>
                    <input type="text" class="form-control" name="skillGroup" id="skillGroup" oninput="emptySkillGroupText()" value="{{ $queue->skillGroup }}">
                    <small>Seleziona specializzazione già esistente</small>
                    <select class="form-select" onchange="fillSkillGroup()" name="skillGroupSelect" id="skillGroupSelect">
                            <option value=""></option>
                            <option value="Specializzazione 1">Specializzazione 1</option>
                            <option value="Specializzazione 2">Specializzazione 2</option>
                            <option value="Specializzazione 3">Specializzazione 3</option>
                    </select>
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    <button type="submit">
                        <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                        <span style="float: center;">
                            Salva
                        </span>
                    </button><br>
                    <button type="reset">
                        <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                        <span style="float: center;">
                            Reimposta campi
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg>
            <i>Code</i>
        </h3><br>
        @if (session('updated'))
        <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto; margin-bottom: 10px;">
            <span style="float: left;">Coda aggiornata</span>
            <span style="float: right;" onclick="closeAlert()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </span>
        </div>
        @endif
    </div>
    <div class="col">
        <form action="{{ route('queues.update', $queue->id) }}" method="POST">
            @csrf
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Servizio</label>
                <input type="text" class="form-control" name="service" id="service" value="{{ $queue->servizio }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Coda</label>
                <input type="number" class="form-control" name="queue" id="queue" value="{{ $queue->coda }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tipologia</label>
                <select class="form-select" name="tipology" id="tipology">
                    <option value=""></option>
                    <option value="principale" {{ $queue->tipologia == 'principale' ? 'selected' : '' }}>Principale</option>
                    <option value="secondaria" {{ $queue->tipologia == 'secondaria' ? 'selected' : '' }}>Secondaria</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Specializzazione</label>
                <input type="text" class="form-control" name="skillGroup" id="skillGroup" oninput="emptySkillGroupText()" value="{{ $queue->skillGroup }}">
                <small>Seleziona specializzazione già esistente</small>
                <select class="form-select" onchange="fillSkillGroup()" name="skillGroupSelect" id="skillGroupSelect">
                        <option value=""></option>
                        <option value="Specializzazione 1">Specializzazione 1</option>
                        <option value="Specializzazione 2">Specializzazione 2</option>
                        <option value="Specializzazione 3">Specializzazione 3</option>
                </select>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <button type="submit">
                    <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                    <span style="float: center;">
                        Salva
                    </span>
                </button><br>
                <button type="reset">
                    <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                    <span style="float: center;">
                        Reimposta campi
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('partials.bottom')

<script>
    function fillSkillGroup(){
        var skillGroupSelected = document.getElementById('skillGroupSelect').value;
        if( skillGroupSelected != "" ) {
            document.getElementById('skillGroup').value = skillGroupSelected;
        } else if ( skillGroupSelected == "" ) {
            document.getElementById('skillGroup').value = "";
        }
    }

    function emptySkillGroupText(){
        var skillGroupText = document.getElementById('skillGroup').value
        if (skillGroupText === "") {
            document.getElementById('skillGroupSelect').selectedIndex = 0;
        }

    }

    // Funzione di chiusura alert
    function closeAlert() {
        document.getElementById('successAlert').style.display = "none";
    }
</script>

<style>

    .col {
        border: 1px solid lightgray;
        border-radius: 10px;
        display: flex;
        justify-content: center;
    }

    form {
        width: 50%;
    }
    form button {
        width: 70%;
        text-align: center;
    }

    /* Form media query mobile */
    @media only screen and (max-width: 600px) {
        form {
            width: 100%;
        }   
    }
        
    button {
        height: 40px;
        border: 1px solid darkgray;
        border-radius: 35px;
        background-color: white;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>