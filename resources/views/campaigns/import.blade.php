@include('partials.top')
@include('navbar')

<div class="container">
    <div class="row">
        <h3 style="margin-top: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/></svg>
            Importazione liste
        </h3>
        <div class="col">
            <div style="border: 1px solid darkgray; padding: 5px; border-radius: 5px; margin-bottom: 10px;">
                Carica la matrice Excel per importare delle liste<br>
                Le liste verranno importate per la campagna <strong>{{ $campaigns->name }}</strong>
            </div>

            <div style="border: 1px solid darkgray; padding: 5px; border-radius: 5px; margin-bottom: 10px;">
                <form action="{{ route('contratti.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <i>Nota bene: puoi caricare solo file di tipo Excel</i><br>
                    <input type="file" id="matrice" name="file" accept=".xls,.xlsx" required><br>
                    <button type="submit" style="margin-top: 10px;">Carica</button>
                    <button type="reset" style="margin-top: 10px;">Annulla file da importare</button>
                </form>
              
            </div>

            @if (session('success'))
            <div style="border: 1px solid darkgray; padding: 5px; border-radius: 5px; margin-bottom: 10px;">
                @if(session('success'))
                    <p>{{ session('success') }}</p>
                @endif
            </div>
            @endif

            @if (session('error'))
            <div style="border: 1px solid darkgray; padding: 5px; border-radius: 5px; margin-bottom: 10px;">
                @if(session('error'))
                    <p>{{ session('error') }}</p>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

@include('partials.bottom')

<style>
    form {
        /* display: flex;
        flex-direction: row; */
    }
</style>

<script>
    
</script>