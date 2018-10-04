<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Comments</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/pe-icon-7-stroke/css/helper.css') }}" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="container-header">
        <div class="row mb-3">
            <div class="col-12">
                <img class="rounded-circle icon-circle float-left" src="{{ asset('img/jack.png') }}">
                <h4 class="mb-0">Jack Sparrow</h4>
                <span class="text-muted small">3hr ago, from Black Pearl</span>
            </div>

        </div>
        <p class="small">Daft Punk are a French electronic music duo formed in Paris in 1993 by Guy-Manuel de Homem-Christo and Thomas Bangalter. They achieved popularity in the late 1990s as part of the French house movement, and had success in the years following. </p>
        <hr/>
        <a href="#" class="comment-link text-muted"><span class="pe-7s-micro"></span> Comment</a>
    </div>
    <div class="container-body comments">
        <div class="commentsLoading"></div>
    </div>
    <div class="container-footer">
        <form id="newCommentForm" method="POST" action="{{ route('commentNew', array('idCommentParent'=>0)) }}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
            <input id="name" name="name" type="text" class="form-control mb-3" placeholder="Name">
            <textarea id="comment" name="comment" type="text" class="form-control mb-3" placeholder="Write a Comment"></textarea>
            <button type="submit" class="btn btn-outline-info btn-block"><span class="pe-7s-pin"></span> Post</button>
        </form>

    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        ajaxRequest('{{ route('commentListView') }}', function (response) {
            $('.comments').html(response);
        })
    });
</script>
</body>
</html>
