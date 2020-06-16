<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 5 star rating example using jQuery star rating plugin</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</head>
<body>


<div class="container">


    <h2>Bootstrap 5 star rating example using jQuery star rating plugin</h2>


    <br/>
    <label for="input-1" class="control-label">No stars yet:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="0.5" data-size="xs">

    <br/>
    <label for="input-1" class="control-label">One star:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="1" data-min="0" data-max="5" data-step="0.5" data-size="xs">

    <br/>
    <label for="input-1" class="control-label">Two stars:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="2" data-min="0" data-max="5" data-step="0.5" data-size="sm">

    <br/>
    <label for="input-1" class="control-label">Three stars:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="3" data-min="0" data-max="5" data-step="0.5" data-size="md">

    <br/>
    <label for="input-1" class="control-label">Four stars:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="4" data-min="0" data-max="5" data-step="0.5" data-size="lg">

    <br/>
    <label for="input-1" class="control-label">Five stars:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="5" data-min="0" data-max="5" data-step="0.5" data-size="xl">

    <br/>
    <label for="input-1" class="control-label">Read only stars:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="3" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xl">

    <br/>
    <label for="input-1" class="control-label">Hide clear icon:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" value="3"  data-show-clear="false" data-show-caption="true">


</div>


<script>
$("#input-id").rating();
</script>


</body>
</html>