@extends('technician.layouts.app')
@section('title', 'Comments - Helpdesk')
@section('content')

<!-- Isi Kontent -->

<div class="container">
    <h3 class="mt-3">{{ $ticket->title }}</h3>
    <p class="fs-5">{{ $ticket->user->email }}</p>
    <img src="/storage/images/{{ $ticket->picture }}" width="65%" class="">
    <hr>
    <p class="fw-semibold fs-5">Description Ticket</p>
    <p>{{ $ticket->description }}</p>
</div>


<div class="container">
<div class="card mt-3 mb-3">
  <h5 class="card-header">Comment</h5>
  <form action="{{ url('technician/commentss') }}" method="post">
      {{ csrf_field() }}
  <div class="card-body">
      <input type="hidden" name="ticket_slug" value="{{ $ticket->slug }}">
    <textarea name="comment" id="comment" class="form-control desc" placeholder="Input Comment Here"></textarea>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
  </form>
    <hr>

    @forelse($ticket->comment as $item)
        <div class="comments"> 
        <!-- foreach -->
            <div class="comment">
                <div class="comment-header">
                    <div class="comment-meta">
                        <span class="comment-author-name fw-semibold">
                            @if($item->user)
                                {{ $item->user->name }}
                                @if($item->user->role_id == 2)
                                <i class="fa-solid fa-pencil"></i>
                                @endif
                            @endif
                        </span>
                    </div>
                </div>
                <div class="comment-body">
                    <p>{!! $item->comment !!}</p>
                </div>
                @if(Auth::check() && $item->user_id == Auth::user()->id)
                <div>
                    <a href="{{ route('delete-commentss', $item->id) }}" type="button" class="btn btn-danger">Delete</a>
                </div>
                @endif
            <hr>
        <!-- endforeach -->
        </div>
    @empty
        <h6>No Comment</h6>
    @endforelse
  </div>
</div>
</div>

<!-- End Kontent -->
<script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
<script>
    /*CKEDITOR.replaceClass = 'desc';*/
</script>

@endsection