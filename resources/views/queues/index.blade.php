@include('partials.top')
@include('navbar')

<!-- Modal utilizzato per l'eliminazione della coda -->
@foreach ($queues as $queue)
    <div class="modal fade" id="queueModal{{ $queue->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">⚠ Attenzione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-weight: bold;">
                Sei sicuro di voler eliminare la coda {{ $queue->servizio }}?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('queues.destroy', $queue->id )}}" method="POST">
                        @csrf
                        @method('DELETE')
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
        <h3 style="color: white; -webkit-text-stroke: 1px black;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg>
            Code
        </h3><br>
        @if (session('success'))
        <div id="successAlert" class="alert alert-success" role="alert" style="width: 300px; margin: 0 auto;">
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
        <div>
            <a href="{{ route('queues.create') }}" class="defaultBtn" style="float: left; width: fit-content; text-decoration: none; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                    Aggiungi nuova coda
            </a>
            @if (count($queues) > 0)
                <p style="float: right; color: white; -webkit-text-stroke: 1px black;">
                    Code totali presenti: <strong>{{ $queues->count() }}</strong>
                </p>
            @endif<br>
        </div><br>
        <div class="col" style="margin-top: 10px;">
            @foreach ($queues as $queue)
                <div class="card">
                    <div class="card-header" style="color: white; background-color: #5F57A1">
                        <span style="float: left;">
                            {{ $queue->servizio}}
                        </span>
                        <span style="float: right; display: flex; gap: 0.5rem; align-items: center;">
                            <a href="{{ route('queues.edit', $queue->id )}}" style="align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#queueModal{{ $queue->id }}" style="border: none; background: transparent; padding: 0; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg>
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-text">{{ $queue->coda}}</h5>
                        <h5 class="card-text">{{ $queue->tipologia}}</h5>
                        <h5 class="card-text">{{ $queue->skillGroup}}</h5>
                    </div>
                </div><br>
            @endforeach
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