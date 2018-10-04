@php
    $formCount = 1;
@endphp

@forelse($comments as $comment)
    <div class="comment">
        <div class="row mb-3">
            <div class="col-12">
                <img class="icon-circle float-left" src="{{ asset('img/user.svg') }}">
                <h5 class="mb-0">{{ $comment['parent']->name }}</h5>
                <span class="text-muted small">@date($comment['parent']->date)</span>
            </div>

        </div>
        <p class="small">{{ $comment['parent']->comment }} </p>
        <a class="small" data-toggle="collapse" data-target="#collapse{{$formCount}}">Reply</a>
        <div id="collapse{{$formCount}}" class="collapse">
            <form id="newCommentForm{{ $formCount+=1 }}" class="mt-2" method="POST" action="{{ route('commentNew', array('idCommentParent'=>$comment['parent']->id)) }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                <input id="name" name="name" type="text" class="form-control mb-3" placeholder="Name">
                <textarea id="comment" name="comment" type="text" class="form-control mb-3" placeholder="Write a Comment"></textarea>
                <button type="submit" class="btn btn-outline-info btn-block"><span class="pe-7s-pin"></span> Post</button>
            </form>
        </div>
        <script>
            initFormValidations("newCommentForm{{ $formCount }}");
        </script>
    </div>
    @foreach($comment['firstLevel'] as $commentFirstLevel)
        <div class="comment ml-5">
            <div class="row mb-3">
                <div class="col-12">
                    <img class="icon-circle float-left" src="{{ asset('img/user.svg') }}">
                    <h5 class="mb-0">{{ $commentFirstLevel->name }}</h5>
                    <span class="text-muted small">@date($commentFirstLevel->date)</span>
                </div>

            </div>
            <p class="small">{{ $commentFirstLevel->comment }} </p>
            <a class="small" data-toggle="collapse" data-target="#collapse{{$formCount}}">Reply</a>
            <div id="collapse{{$formCount}}" class="collapse collapsed">
                <form id="newCommentForm{{ $formCount+=1 }}" class="mt-2" method="POST" action="{{ route('commentNew', array('idCommentParent'=>$commentFirstLevel->id)) }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                    <input id="name" name="name" type="text" class="form-control mb-3" placeholder="Name">
                    <textarea id="comment" name="comment" type="text" class="form-control mb-3" placeholder="Write a Comment"></textarea>
                    <button type="submit" class="btn btn-outline-info btn-block"><span class="pe-7s-pin"></span> Post</button>
                </form>
            </div>
            <script>
                initFormValidations("newCommentForm{{ $formCount }}");
            </script>
        </div>
    @endforeach
    @foreach($comment['secondLevel'] as $commentSecondLevel)
        <div class="comment ml-7">
            <div class="row mb-3">
                <div class="col-12">
                    <img class="icon-circle float-left" src="{{ asset('img/user.svg') }}">
                    <h5 class="mb-0">{{ $commentSecondLevel->name }}</h5>
                    <span class="text-muted small">@date($commentSecondLevel->date)</span>
                </div>

            </div>
            <p class="small">{{ $commentSecondLevel->comment }} </p>
        </div>
    @endforeach
    <script>
        $('.collapse').collapse('hide');
    </script>
@empty
    <div class="panel panel-default panel-alert">
        Records not found
    </div>
@endforelse




