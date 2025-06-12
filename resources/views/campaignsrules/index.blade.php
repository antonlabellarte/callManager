@include('partials.top')
@include('navbar')

<div class="container">
    <div class="row">
        <div class="col">
            <div style="margin-top: 10px;">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/></svg>
                    <i>Regole (TSAP01CampagneRegole)</i>
                </h3><br>
                <h5>
                    Regole totali: {{ $campaignsRules->count() }}
                </h5><br>
                <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data" style="display: none;" id="excelForm">
                    @csrf
                    <input type="file" name="file_excel" required>
                    <button type="submit" style="padding: 10px;">Importa</button>
                </form>
                <a href="#" class="defaultBtn" style="float: left; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                    Aggiungi nuova campagna
                </a>
                <button onclick="showExcelForm()" style="float: right; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/></svg>
                    Importa da un file Excel
                </button>
            </div>
            @if (count($campaignsRules) > 0)
                <table class="table" style="margin-top: 10px;">
                        <tr style="border: 1px solid black;">
                            <th style="color: white; background-color: black;">ID</th>
                            <th style="color: white; background-color: lightgray; color: black;">Testo</th>
                            <th style="color: white; background-color: black;">Coda</th>
                            <th style="color: white; background-color: lightgray; color: black;">Abbattimento</th>
                            <th style="color: white; background-color: black;">Nome campagna</th>
                            <th style="color: white; background-color: lightgray; color: black;">Data inizio</th>
                            <th style="color: white; background-color: black;">Data fine</th>
                            <th style="color: white; background-color: lightgray; color: black;">All customers</th>
                            <th style="color: white; background-color: black; color: lightgray; width: 150px;">Opzioni</th>
                        </tr>
                        @foreach ($campaignsRules as $campaignRule)
                        <tr>
                            <td>
                                {{ $campaignRule->idCampagna }}
                            </td>
                            <td>
                                <div style="max-height: 6rem; overflow-y: auto;">
                                    {{ $campaignRule->testo }}
                                </div>
                            </td>
                            <td>{{ $campaignRule->coda }}</td>
                            <td>
                                @if ($campaignRule->abbattimento == 1)
                                Attivo
                                @else
                                Disattivo
                                @endif
                            </td>
                            <td>{{ $campaignRule->nomeCampagna }}</td>
                            <td>{{ $campaignRule->dataInizio }}</td>
                            <td>{{ $campaignRule->dataFine }}</td>
                            <td>
                                @if ($campaignRule->allCustomer == 1)
                                Attivo
                                @else
                                Disattivo
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('campaignrules.edit', $campaignRule->id) }}" class="tableBtn" style="background-color: transparent;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>
                                </a>
                                <a href="#" class="tableBtn" style="background-color: transparent;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                                </a>
                                <button class="tableBtn" data-bs-toggle="modal" data-bs-target="#campaignRulesModal{{ $campaignRule->idCampagna }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                </table>
                
                <!-- Link di paginazione -->
                {{-- {{ $campaignsRules->links() }} --}}
                
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

    
    table, th, tr, td {
        border: 1px solid black;
        text-align: center;
    }
    .tableBtn {
        text-align: center;
        padding: 5px;
        transition: 0.2s;
        border-color: transparent;
        background-color: transparent;

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
</style>
    
<script>
    function showExcelForm(){
        document.getElementById('excelForm').style.display = "block";
    }
</script>