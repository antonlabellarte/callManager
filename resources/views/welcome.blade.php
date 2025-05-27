@include('navbar')
@include('partials.top')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4>Benvenuto</h4><br>
            <a href="{{ route('rules.index') }}">
                <span style="float: left;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-1-square" viewBox="0 0 16 16"><path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z"/><path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg>
                </span>
                <span style="float: center;">
                    Gestione regole
                </span>
            </a>
            <a href="#">
                <span style="float: left;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-2-square" viewBox="0 0 16 16"><path d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306"/><path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg>
                </span>
                <span style="float: center;">
                    Gestione code
                </span>
            </a>
            <a href="{{ route('campaigns.index') }}">
                <span style="float: left;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-3-square" viewBox="0 0 16 16"><path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318"/><path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/></svg>
                </span>
                <span style="float: center;">
                    Gestione campagne
                </span>
            </a>
        </div>
    </div>
</div>


<style>
    .col {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .container {
        display: flex;
        justify-content: center;
    }

    table {
        border: 1px solid black;
        border-radius: 5px;
    }

    /* Anchor */
    a {
        transition: 0.2s;
        margin-bottom: 10px;
        width: 300px;
        border: 1px solid darkgray;
        padding: 10px;
        border-radius: 10px;
        text-decoration: none;
        color: black;
    }

    /* Anchor hover */
    a:hover {
        outline: 1px solid black;
        background-color: whitesmoke;
    }

</style>
@include('partials.bottom')