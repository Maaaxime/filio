<script src="{{ asset('js/picker.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        const dateFormat = 'DD/MM/YYYY';
        const timeFormat = 'HH:mm';

        moment().format();

        var timePickers = [];
        $('.js-mini-picker-time').each(function(e) {
            var picker = new Picker($(this)[0], {
                container: '#' + $(this)[0].id + '.js-mini-picker-container',
                format: timeFormat,

                controls: true,
                inline: true,
                rows: 1,
                pick: onTimePick
            });

            if ($(picker.element).hasClass('disabled')) {
                $(this)[0].min = $(this)[0].value;
                $(this)[0].max = $(this)[0].value;

                $(picker.element.picker.picker.children[0]).addClass('disabled');
            }

            timePickers.push(picker);
        });

        var datePickers = [];
        $('.js-mini-picker-date').each(function(e) {
            var picker = new Picker($(this)[0], {
                container: '#' + $(this)[0].id + '.js-mini-picker-container',
                format: dateFormat,

                controls: true,
                inline: true,
                rows: 1,
                pick: onDatePick
            });

            if ($(picker.element).hasClass('disabled')) {
                $(this)[0].min = $(this)[0].value;
                $(this)[0].max = $(this)[0].value;
                
                $(picker.element.picker.picker.children[0]).addClass('disabled');
            }
            
            datePickers.push(picker);
        });

        function onTimePick() {
            var selectedTime = moment($(this)[0].picker.getDate(true), timeFormat);

            if ($(this)[0].max != null) {
                var inputMaxValue = moment($(this)[0].max, timeFormat);
                if (inputMaxValue < selectedTime) {
                    $(this)[0].value = inputMaxValue.format(timeFormat);
                    $(this)[0].picker.setDate(inputMaxValue);
                    $(this)[0].picker.update();
                }
            }

            if ($(this)[0].min != null) {
                var inputMinValue = moment($(this)[0].min, timeFormat);
                if (inputMinValue > selectedTime) {
                    $(this)[0].value = inputMinValue.format(timeFormat);
                    $(this)[0].picker.setDate(inputMinValue);
                    $(this)[0].picker.update();
                }
            }
        }

        function onDatePick() {
            var selectedDate = moment($(this)[0].picker.getDate(true), dateFormat);

            if ($(this)[0].max != null) {
                var inputMaxValue = moment($(this)[0].max, dateFormat);
                if (inputMaxValue < selectedDate) {
                    $(this)[0].value = inputMaxValue.format(dateFormat);
                    $(this)[0].picker.setDate(inputMaxValue);
                    $(this)[0].picker.update();
                }
            }

            if ($(this)[0].min != null) {
                var inputMinValue = moment($(this)[0].min, dateFormat);
                if (inputMinValue > selectedDate) {
                    $(this)[0].value = inputMinValue.format(dateFormat);
                    $(this)[0].picker.setDate(inputMinValue);
                    $(this)[0].picker.update();
                }
            }
        }

    });
</script>
