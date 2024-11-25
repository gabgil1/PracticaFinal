<?php
$url = ControladorPlantilla::url();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <h1>¡Error 404! Página no encontrada</h1>
                <div class="card-header">
                    <img src="<?php echo $url; ?>vistas/assets/img/error404.png" alt="error 404" style="width: 100%; max-width: 400px;">
                </div>
                <div class="card-body">
                    <p>Lo sentimos, pero la página que buscas no está disponible. <a href="/sistema">página principal</a>.</p>
                </div><!-- end card body -->
            </div>
        </div>
    </div>
</div>