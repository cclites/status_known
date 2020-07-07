<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Test Page</h1>
        <div id="sk_app">
           <script src="{{ env('API_BASE_PATH') }}loader?api_token={{ env('API_DEV_TOKEN') }}" type="text/javascript"></script>
        </div>

    </body>
</html>
