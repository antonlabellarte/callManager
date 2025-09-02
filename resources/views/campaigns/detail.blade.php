@include('partials.top')
@include('navbar')

<div class="modal" tabindex="-1" id="campaignListModal{{ $campaign->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attenzione</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            Sei sicuro di voler eliminare tutte le liste associate a questa campagna?<br>
        </p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('campaigns.destroylist', $campaign->id ) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <h3 style="margin-bottom: 20px; margin-top: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-layout-text-window" viewBox="0 0 16 16"><path d="M3 6.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v1H1V2a1 1 0 0 1 1-1zm1 3v10a1 1 0 0 1-1 1h-2V4zm-4 0v11H2a1 1 0 0 1-1-1V4z"/></svg>
            Dettaglio campagna {{ $campaign->id }}
        </h3>
        <div class="col-sm">
            <label>
                Dati campagna
                <a class="editCampaignBtn" href="{{ route('campaigns.edit', $campaign->id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                    Modifica campagna
                </a>
            </label>
            ID: {{ $campaign->id }}<br>
            Testo: {{ $campaign->message }}<br>
            Coda: {{ $campaign->queue }}<br>
            Forzacoda: @if($campaign->toQueue == 1) Sì @else No @endif<br>
            Abbattimento: @if($campaign->dropCall == 1) Sì @else No @endif<br>
            Nome campagna: {{ $campaign->name }}<br>
            Data Inizio: {{ $campaign->dateStart }}<br>
            Data fine: {{ $campaign->dateEnd }}<br>
            All customer: @if($campaign->allCustomer == 1) Sì @else No @endif<br>
        </div>
        <div class="col-sm">
            <label style="margin-bottom: 20px;">Liste associate alla campagna {{ $campaign->name }}
                @if (count($listsPerCampaign) > 0)
                <button id="" style="float: right;" data-bs-toggle="modal" data-bs-target="#campaignListModal{{ $campaign->id }}">Elimina liste</button>
                @endif
            </label>
            <label>Cerca <a href="{{ route('campaigns.detail', $campaign->id)}}" style="float: right; text-decoration: none; border: 1px solid black; border-radius: 5px; color: black; backgroun-color: white; padding: 5px;">Reset</a></label>
            <form action="{{ route('campaigns.findCustomerID', $campaign->id) }}" method="GET">
                @csrf
                @method('GET')
                <input type="text" name="customerID" id="customerID "style="width: 50%;" @if (count($listsPerCampaign) < 1) disabled @endif>
                <button type="submit" style="height: 35px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                </button>
            </form>
                @if (count($listsPerCampaign) > 0)
                <p style="overflow-y: scroll; border: 1px solid darkgray; padding: 5px; border-radius: 5px; margin-top: 20px;">
                        @foreach ($listsPerCampaign as $listPerCampaign)
                        {{ $listPerCampaign->customerID }} - 
                        @endforeach
                </p>
                @else
                <div class="alert alert-secondary" role="alert" style="margin-top: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-database-fill-x" viewBox="0 0 16 16"><path d="M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/><path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905"/><path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708"/></svg>
                    @if ($campaign->allCustomer == 1)
                    Vale per tutti i chiamanti
                    @else
                    Nessuna lista associata
                    @endif
                </div>
                <a href="{{ route('campaigns.indexImport', $campaign->id )}}" class="btn btn-light" style="border-color: black;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/></svg>
                    Importa delle liste
                </a>
                @endif
        </div>
    </div>
</div>

@include('partials.bottom')

<style>
    .container {
        margin: 0 auto;
    }
    
    .col-sm {
        display: flex;
        flex-direction: column;
        border: 1px solid darkgray;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
    }

    .editCampaignBtn {
        border: 1px solid black;
        border-radius: 5px;
        padding: 5px;
        color: black;
        text-decoration: none;
    }

    .editCampaignBtn:hover {
        transition: 0.2s;
        background-color: lightgray;
    }
</style>