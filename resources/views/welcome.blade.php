<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="//fonts.googleapis.com/css?family=Lato:100"
          rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <!--<div class="content">
        <h1>Search results</h1>
        <ul class="list-group">
            {{--@foreach($results as $contact)--}}
                <li class="list-group-item">
                    {{-- $contact['name'] --}}
                </li>
            {{--@endforeach--}}
        </ul>
    </div>-->

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <label for="name" class="text-laravel">Search:</label>
                </div>
                <input type="search" name="name" id="name" class="form-control"
                       v-model="name" v-on="keyup:search | key 'enter'">
            </div>
        </div>

        <div class="results text-center">
            <article v-repeat="contact: contacts">
                <h2>
                    @{{{ contact._highlightResult.name.value }}}
                    (@{{{ contact._highlightResult.company.value }}})
                </h2>
            </article>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.12.7/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    new Vue({
        el: 'body',
        data: {
            name: '',
            contacts: []
        },
        ready: function () {
            this.client = algoliasearch('YWJEOV99K4', '50aba46cb049178b276f41c3b49907b5');
            this.index = this.client.initIndex('test_drive_contacts');

            $('#name').typeahead({
                    hint: false
                },
                {
                    source: this.index.ttAdapter(),
                    displayKey: 'name'
                }
            ).on('typeahead:select',
                function (e, suggestion) {
                    this.name = suggestion.name;
                }.bind(this)
            );
        },
        methods: {
            search: function () {
                if (this.name.length < 3) {
                    return;
                }

                this.index.search(this.name, function (error, results) {
                    this.contacts = results.hits;
                }.bind(this));
            }
        }
    });
</script>

</body>
</html>
