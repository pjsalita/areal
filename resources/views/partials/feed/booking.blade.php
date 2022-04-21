
<div class="modal" id="bookAppointment" tabindex="-1" role="dialog" aria-labelledby="Book Appointment Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title">
                    <h1 class="text mb-1">APPOINTMENT DETAILS</h1>
                </div>
            </div>
            <form class="form booking-form pt-0" onsubmit="bookAppointment(event)">
                <fieldset>
                    {{-- <div class="row -first mx-0">
                        <div class="col column -first px-0">
                            <div class="input-block">
                                <label for="boo-first-name">FIRST NAME</label>
                                <input id="book-first-name" type="text" required>
                            </div>
                        </div>
                        <div class="col column -second px-0">
                            <div class="input-block">
                                <label for="book-last-name">LAST NAME</label>
                                <input id="book-last-name" type="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row -second mx-0">
                        <div class="col column -first px-0">
                            <div class="input-block">
                                <label for="book-email">EMAIL</label>
                                <input id="book-email" type="email" required>
                            </div>
                        </div>
                        <div class="col column -second px-0">
                            <div class="input-block">
                                <label for="book-number">PHONE NUMBER</label>
                                <input id="book-number" type="text" required>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row -third mx-0">
                        <div class="col column -first px-0">
                            <div class="input-block">
                                <input type="hidden" id="book-architect-id" />
                                <label for="book-start-date">APPOINTMENT DATE</label>
                                <input id="book-date" type="text" required />
                            </div>
                        </div>
                        {{-- <div class="col column -second px-0">
                            <div class="input-block">
                                <label for="book-end-date">END DATE</label>
                                <input id="book-end-date" type="text" name="end_date" required>
                            </div>
                        </div> --}}
                    </div>
                    <div class="input-block">
                        <label for="book-message">MESSAGE</label>
                        <textarea name="book-message" id="book-message" name="message" cols="30" rows="4"></textarea>
                    </div>
                </fieldset>
                <button type="submit" class="action primary">BOOK APPOINTMENT</button>
            </form>
        </div>
    </div>
</div>

@push("scripts")
    <script>
        $(function() {
            $('#book-date').daterangepicker({
                timePicker: true,
                minDate: new Date(),
                startDate: moment().startOf('hour').add(1, 'hour'),
                endDate: moment().startOf('hour').add(2, 'hour'),
                timePickerIncrement: 30,
                maxSpan: {
                    "hours": 24
                },
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
        });

        const bookAppointment = async (event) => {
            event.preventDefault()
            const { data } = await axios.post("/appointment", {
                architect_id: $("#book-architect-id")[0].value,
                dates: $("#book-date")[0].value,
                message: $("#book-message")[0].value,
            });

            if (data.success) {
                window.location.href = `/appointment/${data.appointment_id}`
            }
        }
    </script>
@endpush
