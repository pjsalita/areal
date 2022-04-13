
<div class="modal" id="bookAppointment" tabindex="-1" role="dialog" aria-labelledby="Book Appointment Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title">
                    <h1 class="text mb-1">APPOINTMENT DETAILS</h1>
                </div>
            </div>
            <form class="form booking-form pt-0">
                <fieldset>
                    <div class="row -first mx-0">
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
                    </div>
                    <div class="row -third mx-0">
                        <div class="col column -first px-0">
                            <div class="input-block">
                                <label for="book-date">DATE</label>
                                <input id="book-date" type="date" required>
                            </div>
                        </div>
                        <div class="col column -second px-0">
                            <div class="input-block">
                                <label for="book-time">TIME</label>
                                <input id="book-time" type="time" min="8:00" max="16:00" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-block">
                        <label for="book-message">MESSAGE</label>
                        <textarea name="book-message" id="book-message" cols="30" rows="4"></textarea>
                    </div>
                </fieldset>
                <button type="submit" class="action primary">BOOK APPOINTMENT</button>
            </form>
        </div>
    </div>
</div>
