<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" value="{{ csrf_token() }}"/>
        <title>Car Listing - Dev Test</title>
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div class="uk-background-secondary">
            <section class="uk-section uk-section-small uk-section-default uk-padding-remove-bottom">
                <div id="app" class="uk-container uk-container-expand uk-margin-large-bottom">
                </div>
            </section>
        </div>
        <script>
             var BASE_URL = `{{ url('') }}`;
        </script>
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
