@php $token = '$2y$10$56hsjik7ZTrGhAELdmXt0eKOKSsSaTsA/tMFhLKsNHD8ZtGyWqIge'; @endphp

<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Test Page</h1>
        <div>
            <iframe src="http://192.168.10.10/api/gateway?token={{ $token }}" style="width: 100%;"></iframe>
        </div>

    </body>
</html>
