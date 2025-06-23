@include('partials.top')
@include('navbar')

<div class="container">
    <div class="row">
        <div class="col-sm">
            ID: {{ $rule->idCampagna }}
            Testo: {{ $rule->testo }}
            Coda: {{ $rule->coda }}
            Abbattimento: {{ $rule->abbattimento }}
            Nome campagna: {{ $rule->nomeCampagna }}
            Data Inizio: {{ $rule->dataInizio}}
            Data fine: {{ $rule->dataFine}}
            All customer: {{ $rule->allCustomer }}
        </div>
        <div class="col-sm">
            Liste correlate
            N per regola

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
    }
</style>