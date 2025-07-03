@include('partials.top')
@include('navbar')

<!-- Modal utilizzato per l'eliminazione della coda -->
@if (count($campaigns) > 0)
    @foreach ($campaigns as $campaign)
        <div class="modal fade" id="campaignRuleModal{{ $campaign->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">⚠ Attenzione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-weight: bold;">
                    Sei sicuro di voler eliminare la campagna {{ $campaign->nomeCampagna }}?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('campaigns.destroy', $campaign->id )}}" method="POST">
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
@endif

<div class="container">
    <div class="row">
        <div class="col">
            <div style="margin-top: 10px;">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/></svg>
                    Campagne
                </h3><br>
                <h5>
                    Regole totali: {{ $campaigns->count() }}
                </h5><br>
                {{-- <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data" style="display: none;" id="excelForm">
                    @csrf
                    <input type="file" name="file_excel" required>
                    <button type="submit" style="padding: 10px;">Importa</button>
                </form> --}}
                <a href="{{ route('campaigns.create')}}" class="defaultBtn" style="float: left; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                    Aggiungi nuova campagna
                </a>
                {{-- <button onclick="showExcelForm()" style="padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/></svg>
                    Importa da un file Excel
                </button> --}}
            </div>
            @if (count($campaigns) > 0)                
                {{-- <table id="my-table">
                <thead>
                    <tr data-sort-method="none">
                        <th>ID</th>
                        <th>Testo</th>
                        <th>Coda</th>
                        <th>Abbattimento</th>
                        <th>Nome campagna</th>
                        <th>Data inizio</th>
                        <th>Data fine</th>
                        <th>All customers</th>
                        <th>Opzioni</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                        <td>
                            {{ $campaign->id }}
                        </td>
                        <td>
                                <div style="max-height: 6rem; overflow-y: auto;">
                                    {{ $campaign->testo }}
                                </div>
                            </td>
                            <td>{{ $campaign->coda }}</td>
                            <td>
                                @if ($campaign->abbattimento == 1)
                                Attivo
                                @else
                                Disattivo
                                @endif
                            </td>
                            <td>{{ $campaign->nomeCampagna }}</td>
                            <td>{{ $campaign->dataInizio }}</td>
                            <td>{{ $campaign->dataFine }}</td>
                            <td>
                                @if ($campaign->allCustomer == 1)
                                Attivo
                                @else
                                Disattivo
                                @endif
                            </td>
                            <td>
                                <div style="flex-direction: row;">
                                    <a href="{{ route('campaignrules.edit', $campaign->id) }}" style="color: black; text-decoration: none; border: 1px solid transparent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>
                                    </a>
                                    <a href="#" style="color: black; text-decoration: none; border: 1px solid transparent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                                    </a>
                                    <button style="color: black; text-decoration: none; border: 1px solid transparent" data-bs-toggle="modal" data-bs-target="#campaignRulesModal{{ $campaign->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table> --}}

                <!-- Link di paginazione -->
                {{-- {{ $campaigns->links() }} --}}

                @foreach ($campaigns as $campaign)
                    <div class="card" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="card-header" style="background-color: #5F57A1; color: white;">
                            <span style="float: left;">
                                <strong>ID: {{ $campaign->id}}# | {{ $campaign->nomeCampagna }}</strong>
                            </span>
                            <span style="float: right;">
                                <a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>
                                </a>
                                <a style="padding: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                                </a>
                                <button data-bs-toggle="modal" data-bs-target="#campaignRuleModal{{ $campaign->id }}" style="border: none; background: transparent; padding: 0; align-items: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg>
                                </button>
                            </span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"  style="border-radius: 10px; border: 1px solid lightgray; padding: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/></svg>
                                    Coda: {{ $campaign->coda }}<br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar4-week" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/><path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/></svg>
                                    Dal {{ \Carbon\Carbon::parse($campaign->dataInizio)->format('d/m/Y H:i') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16"><path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"/></svg>
                                    al 
                                    {{ \Carbon\Carbon::parse($campaign->dataFine)->format('d/m/Y H:i') }}
                            </h6>
                            <h4 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16"><path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/></svg>
                                Messaggio
                            </h4>
                            <p class="card-text" style="padding: 10px; border: 1px solid lightgray; border-radius: 10px; background-color: whitesmoke;">
                                {{ $campaign->testo }}
                            </p>
                            
                            <div style="display: flex; flex-direction: row;">
                                @if ($campaign->abbattimento == 1)
                                    <span style="border: 1px solid lightgray; border-radius: 10px; padding: 10px; margin-right: 5px; width: fit-content; font-size: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ $campaign->abbattimento == 1 ? '#5cb85c' : '#d9534f' }}" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>
                                @endif
                                    Abbattimento
                                    </span>
                                @if ($campaign->abbattimento == 1)
                                    <span style="border: 1px solid lightgray; border-radius: 10px; padding: 10px; margin-right: 5px; width: fit-content; font-size: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ $campaign->allCustomer == 1 ? '#5cb85c' : '#d9534f' }}" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>
                                @endif
                                    Tutti i chiamanti
                                    </span>
                                @if ($campaign->abbattimento == 1)
                                    <span style="border: 1px solid lightgray; border-radius: 10px; padding: 10px; margin-right: 5px; width: fit-content; font-size: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ $campaign->enabled == 1 ? '#5cb85c' : '#d9534f' }}" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>                                        
                                @endif
                                    Attiva
                                    </span>
                                </div>
                        </div>
                    </div>
                @endforeach
                
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
    .container {
        margin: 0 auto;
    }

    .col {
        display: flex;
        flex-direction: column;
    }

    .card {
        border: 1px solid #292b2c;
    }

    
    table {
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
        border-radius: 10px;
    }

    th, td {
        padding: 0.25em;
        color: black;
        border: 1px solid black;
        border-radius: 10px;
    }

    th[role=columnheader]:not(.no-sort) {
        cursor: pointer;
    }

    th[role=columnheader]:not(.no-sort):after {
        content: '';
        float: right;
        margin-top: 7px;
        margin-left: 5px;
        border-width: 0 4px 4px;
        border-style: solid;
        border-color: white transparent;
        visibility: hidden;
        opacity: 0;
        -ms-user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    th[aria-sort=ascending]:not(.no-sort):after {
        border-bottom: none;
        border-width: 4px 4px 0;
    }

    th[aria-sort]:not(.no-sort):after {
        visibility: visible;
        opacity: 0.4;
    }

    th[role=columnheader]:not(.no-sort):hover:after {
        visibility: visible;
        opacity: 1;
    }

    #excelForm {
        border: 1px solid darkgray;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    .pagination {
        color: black;
    }

    .modalConfirmBtn:hover, .modalDeleteBtn:hover {
        border: 1px solid darkgray;
    }
</style>
    
<script>
    function onPageReady() {
    // Documentation: http://tristen.ca/tablesort/demo/
    new Tablesort(document.getElementById('my-table'));
    }

    // Run the above function when the page is loaded & ready
    document.addEventListener('DOMContentLoaded', onPageReady, false);

    function showExcelForm(){
        document.getElementById('excelForm').style.display = "block";
    }
</script>