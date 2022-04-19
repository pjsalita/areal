@section('title', "Messages")

<x-app-layout>
    <div class="my-3 container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-3">
                {{-- @include("partials.chat.conversations") --}}
            </div>
            <div class="col-md-6">
                {{-- @include("partials.chat.messages") --}}
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
@endpush

@push('scripts')
    <script>
        Echo.private('conversation.{{ auth()->id() }}')
            .listen('MessageSent', (e) => {
                this.messages.push({
                message: e.message.message,
                user: e.user
                });
            });
    </script>
@endpush
