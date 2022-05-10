<div class="bottom-0 p-3 toast-container position-fixed end-0" id="notificationToast" style="z-index: 11"></div>

@push('scripts')
@auth
    <script>
        const notificationTemplate = (notification) => `<div class="toast" id="${notification.id}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header position-relative">
                <img src="${notification.user_photo}" width="45" height="45" class="rounded me-2" alt="">
                <span class="me-auto">${notification.toast_message || notification.message}</span>
                <a href="${notification.reference_link}${notification.id ? `?read=${notification.id}` : ""}" class="stretched-link"></a>
                <button type="button" class="btn-close" style="z-index: 1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>`

        @if(!request()->routeIs("user") && !request()->routeIs("chat"))
            const msgChannel = pusher.subscribe("private-chatify");

            msgChannel.bind("messaging", (notification) => {
                if (notification.to_id == {{ auth()->id() }}) {
                    const messagesCount = document.getElementById('messagesCount');
                    const notificationContainer = document.getElementById('notificationToast');
                    const template = notificationTemplate(notification);
                    const element = document.createElement('div');
                    element.innerHTML = template;
                    notificationContainer.appendChild(element.firstChild);
                    const toast = new bootstrap.Toast(notificationContainer.lastChild);

                    if (messagesCount) {
                        messagesCount.innerText = parseInt(messagesCount.innerText || 0) + 1;
                    }
                    toast.show();
                }
            });
        @endif

        Echo.private(`App.Models.User.{{ auth()->id() }}`)
            .notification((notification) => {
                const notificationCount = document.getElementById('notificationCount');
                const notificationContainer = document.getElementById('notificationToast');
                const template = notificationTemplate(notification);
                const element = document.createElement('div');
                element.innerHTML = template;
                notificationContainer.appendChild(element.firstChild);
                const toast = new bootstrap.Toast(notificationContainer.lastChild);

                if (notificationCount) {
                    notificationCount.innerText = parseInt(notificationCount.innerText || 0) + 1;
                }
                toast.show();
            });
    </script>
@endauth
@endpush
