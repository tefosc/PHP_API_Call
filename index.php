<?php
const API_URL = "https://whenisthenextmcufilm.com/api";
# Inicializar una nueva sesión cURL; ch = curl handle
$ch = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Desactivar la verificación de certificados SSL (solo para desarrollo)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);
$curl_error = curl_error($ch); // Capturar errores de cURL
$data = json_decode($result, true);
curl_close($ch);

// una alternativa sería utilizar file_get_contents
// $result = file_get_contents(API_URL); si solo quieres hacer un GET a una API
?>


<head>
    <meta charset="UTF-8" />
    <title>La próxima película de Marvel</title>
    <meta name="description" content="La próxima película de Marvel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>
<main>
    <section>
        <h1>¿Cúal es la siguiente película de Marvel?</h1>
        <img src="<?= $data["poster_url"] ?>" width="200" alt="Poster de <?= $data["title"] ?>" />
    </section>
    <hgroup>
        <h3>¡<?= $data["title"] . " se estrena en " . $data["days_until"] . " días!" ?></h3>
        <p>Fecha de estreno <?= $data["release_date"] ?></p>
        <p>¿Cúal es la siguiente? <strong><?= $data["following_production"]["title"] ?></strong> </p>
    </hgroup>

</main>
<style>
    :root {
        color-scheme: light dark;
    }

    body {
        display: grid;
        place-content: center;
    }

    section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    hgroup {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img {
        margin: 0 auto;
        border-radius: 16px;
    }
</style>