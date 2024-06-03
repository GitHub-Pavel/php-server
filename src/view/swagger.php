<?php
require_once __DIR__ . '/../app/constants.app.php';
require_once __DIR__ . '/../constants/common.php';
require_once __DIR__ . '/../constants/swagger.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-standalone-preset.min.js"></script>
</head>
<body>
<div id="swagger-ui"></div>
<script type="text/javascript">
    window.onload = function() {
        const ui = SwaggerUIBundle({
            url: "<?= SERVER_URL . SWAGGER_URL  ?>",
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "BaseLayout",
            onComplete: () => {

            }
        })
    }

</script>
</body>
</html>