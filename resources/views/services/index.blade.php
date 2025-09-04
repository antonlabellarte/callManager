@include('partials.top')
@include('navbar')

<!-- Modal utilizzato per l'eliminazione della coda -->
@foreach ($services as $service)
    <div class="modal fade" id="serviceModal{{ $service->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">⚠ Attenzione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-weight: bold;">
                Sei sicuro di voler eliminare la coda {{ $service->name }}?
            </div>
            <div class="modal-footer">
                <form action="{{ route('services.destroy', $service->id )}}" method="POST">
                    @csrf
                    @method('DELETE')
                        <!-- Name da passare alla funzione -->
                        <input type="hidden" id="service" name="service" value="{{ $service->name }}">
                        <!-- Queue da passare alla funzione -->
                        <input type="hidden" id="queue" name="queue" value="{{ $service->queue }}">
                        <button type="submit" class="modalConfirmBtn">Elimina</button>
                        <button type="button" class="modalDeleteBtn" data-bs-dismiss="modal">Annulla</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="container">
    <div class="row">
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg>
            Code
        </h3><br>
        @if (session('success'))
        <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto; margin-bottom: 10px;">
            <span style="float: left;">
                Coda inserita
            </span>
            <span style="float: right;">
                <button onclick="closeAlert()" style="border: transparent; background-color: transparent;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </button>
            </span>
        </div>
        @endif

        @if (session('ruleFound') || session('campaignFound'))
        <div class="alert alert-danger" role="alert" style="margin-bottom: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
            @if (session('ruleFound'))
                Regola
            @endif
            @if (session('campaignFound'))
                Campagna
            @endif
            associata esistente.
        </div><br>
        @endif

        @if (session('updated'))
            <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto; margin-bottom: 10px;">
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

        @if (session('serviceDeleted'))
        <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto; margin-bottom: 10px;">
            <span style="float: left;">
                Coda eliminata
            </span>
            <span style="float: right;">
                <button onclick="closeAlert()" style="border: transparent; background-color: transparent;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </button>
            </span>
        </div>
        @endif
        <div>
            <a href="{{ route('services.create') }}" class="defaultBtn" style="float: left; width: fit-content; text-decoration: none; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                    Aggiungi nuova coda
            </a>
            @if (count($services) > 0)
                <p style="float: right;">
                    Code totali presenti: <strong>{{ $services->count() }}</strong>
                </p>
            @endif<br>
        </div><br>

        <div style="margin-top: 10px;">
            <form method="GET" action="{{ route('services.filter') }}" >
                @csrf
                @method('GET')
                <label>Nome</label>
                <input type="text" name="name" id="name">
                <label>Coda</label>
                <input type="number" name="queue" queue="name">
                <label>Tipologia</label>
                <select name="typology" id="typology">
                    <option value=""></option>
                    <option value="principale">Principale</option>
                    <option value="secondaria">Secondaria</option>
                </select>
                <button class="defaultBtn" style="height: 35px;" type="submit">Cerca</button>
                <a href="{{ route('services.index') }}">Reimposta filtri</a>
            </form>
        </div><br>

        <div class="col" style="margin-top: 10px;">
            @if (count($services) > 0)
                <table class="table">
                    <tr>
                        <th style="color: white; background-color: black;">Nome</th>
                        <th style="color: white; background-color: black;">Coda</th>
                        <th style="color: white; background-color: black;">Tipologia</th>
                        <th style="color: white; background-color: black;">Specializzazione</th>
                        <th  style="color: white; background-color: lightgray; color: black;">Opzioni</th>
                    </tr>
                    @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name}}</td>
                        <td>{{ $service->queue}}</td>
                        <td>{{ $service->typology}}</td>
                        <td>{{ $service->skillgroup}}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id)}}" class="tableBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                            </a>
                            <button class="tableBtn" data-bs-toggle="modal" data-bs-target="#ruleModal{{ $service->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            @else
            <div class="alert alert-secondary" role="alert" style="margin-top: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-database-exclamation" viewBox="0 0 16 16"><path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/><path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/></svg>
                Nessun dato presente
            </div>
            @endif
        </div>
    </div>
</div>

@include('partials.bottom')

<style>
    .filterBtn {
        padding: 10px;
    }

    .card {
        border: 1px solid darkgray;
    }

    .card a, .card button {
        display: none;
        text-decoration: none;
        border: none;
        background-color: transparent;
        color: white;
    }

    .card:hover a, .card:hover button {
        display: flex;
    }

    .tableBtn {
        transition: 0.2s;
        text-decoration: none;
        text-align: center;
        color: black;
        margin-bottom: 10px;
        background-color: transparent;
        border: 1px solid transparent;
        width: 40px;
        height: 40px;
    }

    .tableBtn:hover {
        cursor: pointer;
        background-color: transparent;
        border-color: transparent;
        color: black;
    }
    
    @media (max-width: 767px) {
        .card a, .card button {
            display: flex;
            text-decoration: none;
            border: none;
            background-color: transparent;
            color: white;
        }
    }
</style>

<script>
    // Funzione di chiusura alert
    function closeAlert() {
        document.getElementById('successAlert').style.display = "none";
    }
</script>