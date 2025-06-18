@include('partials.top')
@include('navbar')

<div class="container">
    <div class="row" style="text-align: center;">
        <h3>Modifica coda ID: #{{ $queue->id }}</h3>
        <div class="col">
            {{-- <form>
                <p>Servizio</p>
                <input type="text" name="queue" id="queue">
                <p>Coda</p>
                <input type="number" name="queue" id="queue">
                <p>Tipologia</p>
                <input type="text" name="queue" id="queue">
                <p>Specializzazione</p>
                <input type="text" name="skillGroup" id="skillGroup" oninput="emptySkillGroupText()">
                <small>Seleziona specializzazione già esistente</small>
                <select onchange="fillSkillGroup()" name="skillGroupSelect" id="skillGroupSelect">
                        <option value=""></option>
                        <option value="Specializzazione 1">Specializzazione 1</option>
                        <option value="Specializzazione 2">Specializzazione 2</option>
                        <option value="Specializzazione 3">Specializzazione 3</option>
                </select>
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                    Salva
                </button>
                <button type="reset">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                    Reimposta campi
                </button>
            </form> --}}
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
                <button type="submit" style="width: 240px;">
                    <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16"><path d="M11 2H9v3h2z"/><path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/></svg>
                    <span style="float: center;">
                        Salva
                    </span>
                </button><br>
                <button type="reset" style="width: 240px;">
                    <svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                    <span style="float: center;">
                        Reimposta campi
                    </span>
                </button>
            </form>
        </div>
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
</script>

<style>

    .col{
        display: flex;
        justify-content: center;
    }

    /* Form media query mobile */
    @media only screen and (max-width: 600px) {
        
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