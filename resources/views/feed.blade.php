@section('title', Str::ucfirst((auth()->user()->account_type)) . " Feed")

<x-app-layout>
    <div class="my-3 container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-{{ auth()->user()->account_type === "architect" ? "9" : "6" }} gedf-main">
                @architect
                    @include('partials.feed.create-post')
                @endarchitect

                @foreach ($posts as $post)
                    @include('partials.feed.post', [ 'post' => $post ])
                @endforeach
            </div>

            @client
                <div class="col-md-3">
                    @include('partials.feed.architect')
                </div>
            @endclient
        </div>
    </div>

    @include('partials.feed.booking')

    <!-- Markup for Chat -->
    <div class="popup-box chat-popup" id="qnimate">
        <div class="popup-head">
            <div class="popup-head-left pull-left"><img
                    src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                    alt="iamgurdeeposahan"> Gurdeep Osahan</div>
            <div class="popup-head-right pull-right">
                <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="popup-messages">
            <div class="direct-chat-messages">
                <div class="chat-box-single-line">
                    <abbr class="timestamp">October 8th, 2015</abbr>
                </div>
                <div class="direct-chat-msg doted-border">
                    <div class="clearfix direct-chat-info">
                        <span class="direct-chat-name pull-left">Osahan</span>
                    </div>
                    <img alt="message user image"
                        src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                        class="direct-chat-img">
                    <div class="direct-chat-text">
                        Hey bro, how’s everything going ?
                    </div>
                    <div class="clearfix direct-chat-info">
                        <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                    </div>
                    <div class="clearfix direct-chat-info">
                        <span class="direct-chat-img-reply-small pull-left">

                        </span>
                        <span class="direct-chat-reply-name">Singh</span>
                    </div>
                </div>

                <div class="chat-box-single-line">
                    <abbr class="timestamp">October 9th, 2015</abbr>
                </div>
                <div class="direct-chat-msg doted-border">
                    <div class="clearfix direct-chat-info">
                        <span class="direct-chat-name pull-left">Osahan</span>
                    </div>
                    <img alt="iamgurdeeposahan"
                        src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                        class="direct-chat-img">
                    <div class="direct-chat-text">
                        Hey bro, how’s everything going ?
                    </div>
                    <div class="clearfix direct-chat-info">
                        <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                    </div>
                    <div class="clearfix direct-chat-info">
                        <img alt="iamgurdeeposahan"
                            src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                            class="direct-chat-img big-round">
                        <span class="direct-chat-reply-name">Singh</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-messages-footer">
            <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
            <div class="btn-footer">
                <button class="bg_none"><i class="fa fa-film" aria-hidden="true"></i>
                </button>
                <button class="bg_none"><i class="fa fa-camera" aria-hidden="true"></i>
                </button>
                <button class="bg_none"><i class="fa fa-paperclip" aria-hidden="true"></i>
                </button>
                <button class="bg_none pull-right"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
