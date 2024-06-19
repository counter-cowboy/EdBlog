@extends('layouts.main')
@section('content')

    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">
                • {{$date->translatedFormat('d F Y')}} • {{$date->format('H:i')}} •
                {{ $post->comments()->count() }} comments</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/'. $post->preview_image )}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!!  $post->content !!}

                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="py-3">
                        @auth()
                            <form action="{{route('post.like.store', $post->id) }}" method="post">
                                @csrf
                                <span>{{$post->liked_users_count}}</span>

                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fa{{auth()->user()->likedPosts->contains($post->id) ? 's':'r'}}  fa-heart"></i>
                                </button>
                            </form>
                        @endauth
                        @guest()
                            <span>{{$post->liked_users_count}}</span>
                            <i class="far fa-heart"></i>
                        @endguest
                    </section>
                    @if($relatedPosts->count())
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                            <div class="row">
                                @foreach($relatedPosts as $rpost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <img src="{{ asset('storage/'. $rpost->preview_image) }}" alt="related post"
                                             class="post-thumbnail">
                                        <p class="post-category">Category: {{ $rpost->category->title }}</p>
                                        <a href="{{route('post.show', $rpost->id)}}">
                                            <h5 class="post-title">{{ $rpost->title }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{--                    Comments--}}

                    <section class="comment-section mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">
                            Comments: ({{ $post->comments->count() }})
                        </h2>
                        @foreach($post->comments as $comment)

                            <div class="comment-text mb-4">
                                <span class="username">
                                  <div>
                                      {{$comment->DateCarbon->diffForHumans()}}
                                      • {{$comment->DateCarbon->translatedFormat('d F Y')}} • {{$comment->DateCarbon->format('H:i')}} •

                                      By {{ $comment->user->name }}
                                  </div>
                                  <span class="text-muted float-right">Id: {{ $comment-> id}}</span>
                                </span>
                                {{ $comment->message }}
                            </div>
                        @endforeach
                    </section>

                    {{--                    Comments end--}}
                    {{--                    Comment form--}}
                    @auth()
                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Send comment</h2>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Comment</label>
                                        <textarea name="message" id="comment" class="form-control"
                                                  placeholder="Write comment" rows="10">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Send Message" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                    @endauth
                    {{--                    Comment form end--}}
                </div>
            </div>
        </div>
    </main>

@endsection