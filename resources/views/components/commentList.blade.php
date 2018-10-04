@php
    $formCount = 1;
@endphp

@forelse($comments as $comment)
    <div class="comment {{ $comment['level'] }}">
        <div class="row mb-3">
            <div class="col-12">
                <img class="icon-circle float-left" src="{{ asset('img/user.svg') }}">
                <h5 class="mb-0">{{ $comment['comment']->name }}</h5>
                <span class="text-muted small">@date($comment['comment']->date)</span>
            </div>

        </div>
        <p class="small">{{ $comment['comment']->comment }} </p>

        @if( $comment['level'] != "thirdLevel")
        <a class="small" data-toggle="collapse" data-target="#collapse{{$formCount}}">Reply</a>
        @endif

        <div id="collapse{{$formCount}}" class="collapse">
            <form id="newCommentForm{{ $formCount }}" class="mt-2" method="POST" action="{{ route('commentNew', array('idCommentParent'=>$comment['comment']->id)) }}">
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
<script>
    $('.collapse').collapse('hide');
</script>
    @php
        $formCount ++;
    @endphp
@empty
    <div class="panel panel-default panel-alert">
        Records not found
    </div>
@endforelse




