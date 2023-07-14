@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">INSERTION</h5></center>

                    <!-- Vertical Form -->
                    <form action="/util/upload" enctype="multipart/form-data" method="post" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Importez une image</label>
                            <input type="file" name="image" class="form-control" id="inputNanme4">
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
