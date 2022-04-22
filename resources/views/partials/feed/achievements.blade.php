<div class="card">
    <div class="card-header">Achievements</div>
    <div class="card-body">
        <div class="row">
            <div class="control-group" id="fields">
                <div class="controls">
                    <form role="form" autocomplete="off" method="POST" action="{{ route("profile.achievement") }}">
                        @csrf
                        <div class="entries">
                            @foreach ($achievements as $achievement)
                                <div class="mb-2 entry input-group col-xs-3">
                                    <input class="form-control me-2" name="achievement_names[]" type="text" placeholder="Achievement Name" value="{{ $achievement->name }}" />
                                    <input class="form-control me-2" name="achievement_values[]" type="text" placeholder="Achievement Value" value="{{ $achievement->value }}" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger btn-remove" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </span>
                                </div>
                            @endforeach

                            <div class="mb-2 entry input-group col-xs-3">
                                <input class="form-control me-2" name="achievement_names[]" type="text" placeholder="Achievement Name" />
                                <input class="form-control me-2" name="achievement_values[]" type="text" placeholder="Achievement Value" />
                                <span class="input-group-btn">
                                    <button class="btn btn-success btn-add" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $(document).on('click', '.btn-add', function (e) {
                e.preventDefault();

                var controlForm = $('.controls .entries:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fa fa-minus"></i>');
            }).on('click', '.btn-remove', function (e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
    </script>
@endpush
