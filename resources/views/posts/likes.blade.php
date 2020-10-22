@if (count($post->likes) > 0)
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        {{ count($post->likes) }} user(s) liked this post!
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Users who liked this
                        post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @foreach ($post->likes as $like)
                        <table class="table table-stripped text-primary">
                            <tr>
                                <td><img style="border-radius: 50%;" width="24px" height="24px"
                                        src="/storage/profile_images/{{ $like->profile_image }}"/>
                                </td>
                                <th>{{ $like->name }}</th>
                            </tr>
                        </table>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="text-right">Nobody liked this post yet!</div>
@endif

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
</script>
